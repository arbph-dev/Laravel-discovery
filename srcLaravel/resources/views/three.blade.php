<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Three.js dans Laravel</title>
    <style>
        body { margin: 0; }
        canvas { display: block; }
    </style>
</head>
<body>

<script type="importmap">
{
  "imports": {
    "three": "https://unpkg.com/three@0.160.0/build/three.module.js",
	"three/examples/jsm/controls/OrbitControls": "https://unpkg.com/three@0.160.0/examples/jsm/controls/OrbitControls.js",
	"entity": "https://elfennel.fr/public/build/assets/modules/entity.js"
  }
}
</script>

<script type="module">
import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import * as ENTITY from 'entity'

/* ------------------------------------------------------------------------------------------- 
/**Genere un nombre aléatoire entre la borne mini et la borne max 
 * @param {Integer} min Borne mini
 * @param {Integer} max Borne max
 * @returns {Float} 
 */
function getRandomArbitrary(min, max) { return Math.random() * (max - min) + min; }

/* ------------------------------------------------------------------------------------------- */
const TEX = [
	{ id : 1 , path : '/public/img/TJS/textures/test/land_ocean_ice_cloud_2048.jpg' , status : 0 } ,
	{ id : 2 , path : '/public/img/TJS/textures/test/montormel.png' , status : 0 } ,
	{ id : 3 , path : '/public/img/TJS/textures/test/shom11.png' , status : 0 } ,
	{ id : 4 , path : '/public/img/TJS/textures/test/UV_Grid_Sm.jpg' , status : 0 }
]

let raycaster
let PTR_Helper// Pointeur de souris



function getMaterialFromTextures( TEXIDX = 0 )
{
    const T = LoadTexture2( TEXIDX ) 
    const M = new THREE.MeshBasicMaterial( { map: T , side:THREE.DoubleSide} )
    return M
}

function LoadTexture2( TEXIDX = 0 )
{
//.load ( url : String, onLoad : Function, onProgress : Function, onError : Function ) : Texture
 const texture = new THREE.TextureLoader().load(
    TEX[TEXIDX].path , 
    () => { TEX[TEXIDX].status = 2 }, // console.log(TEX) loaded
    () => { TEX[TEXIDX].status = 1 }, //on progres
    () => { TEX[TEXIDX].status = -1 } //error
    );
 //console.log( texture )
 return texture

}



function onMouseMove(event)
{
	let mouse = new THREE.Vector2(); // normalise la position d ela souris et inverse les axes
	mouse.x = ( event.clientX / renderer.domElement.clientWidth ) * 2 - 1;
	mouse.y = - ( event.clientY / renderer.domElement.clientHeight ) * 2 + 1;
	//console.log(mouse)

    let I = getIntersect(mouse , terranMesh ) // on passe la position d ela souris et l objet a raycaster
    if ( I[ 0 ] ) 
    {
    let sTemp = "The X axis is red. The Y axis is green. The Z axis is blue<br/>"
    //sTemp += "position image x " + XP.toFixed(0) + " y " + YP.toFixed(0) + "<br/>";
    sTemp += "image x " + mouse.x.toFixed(4) + " y " + mouse.y.toFixed(4) + "<br/>"
    sTemp += "pos ground x " + I[ 0 ].point.x.toFixed(4) + " y " + I[ 0 ].point.y.toFixed(4) + " z " + I[ 0 ].point.z.toFixed(4);
    //IHM.CONTENT_SetHtml( 'infoWorld' , sTemp );
	console.log( sTemp );
    }
}




function t3js_RealtimeToSimultime()
{
	const ATIME_SCALE = 0.1;//en seconde  100s reel => 10s anmin ATIME_SCALE = 10/100
	const ATIME_T = 10; // 10 seconde 

	const RTIME_t = clock.getElapsedTime();

	const ATIME_t = (RTIME_t * ATIME_SCALE) % ATIME_T;
	const ATIME_N = Math.trunc(RTIME_t/ATIME_T);

	const timer = Date.now() - start;

	let sTemp = "Temps ecoulee " + RTIME_t + "<br/>";
	sTemp += "Temps simulee " + ATIME_t.toFixed(4) + "<br/>";
	sTemp += "Cycles dé&roulés " + ATIME_N.toFixed(4) + "<br/><br/>";
	sTemp += "start  " + start + "<br/>";
	return sTemp
}





/* ===================================================================================================== */

class TerranGenerator {
    #W; #H; #U; #V; #G; #M; #O;
    arrMARKS;

    constructor(TW = 240, TH = 120, VW = 20, VH = 20) {
        this.#W = TW;
        this.#H = TH;
        this.#U = VW;
        this.#V = VH;
        this.#G = new THREE.PlaneGeometry(this.#W, this.#H, this.#U, this.#V);
        this.#M = getMaterialFromTextures(2);
        this.arrMARKS = [];
    }

    fillPlanar(ZMAX = 0, ZMIN = 5) {
        let idxPG = 0;
        for (let iH = 0; iH <= this.#V; iH++) {
            for (let iW = 0; iW <= this.#U; iW++) {
                idxPG = (((this.#U + 1) * iH + iW) * 3) + 2;
                this.#G.attributes.position.array[idxPG] = getRandomArbitrary(ZMIN, ZMAX);
            }
        }
    }

    addMarks(S) {
        const SB = 0.5;
        const SB2 = SB / 2;
        const DW = this.#W / this.#U;
        const DH = this.#H / this.#V;
        const TW2 = this.#W / 2;
        const TH2 = this.#H / 2;

        for (let iH = 0; iH <= this.#V; iH++) {
            for (let iW = 0; iW <= this.#U; iW++) {
                const material = new THREE.MeshStandardMaterial({ color: "red", metalness: 0.5, roughness: 1 });
                let geo = new THREE.BoxGeometry(SB, SB, SB);
                let BOX = new THREE.Mesh(geo, material);
                this.arrMARKS.push(BOX);
                S.add(BOX);
                BOX.position.x = (iW * DW) - TW2 + SB2;
                BOX.position.y = 0;
                BOX.position.z = (iH * DH) - TH2 + SB2;
            }
        }
    }

    setPlaneColor(C = 0xff0f0f) {
        this.#M.color.setHex(C);
    }

    getMesh() {
        this.#G.computeVertexNormals();
        this.#O = new THREE.Mesh(this.#G, this.#M);
        return this.#O;
    }

    getMaterial() { return this.#M; }

    setMaterial(M) { this.#M = M; }
}

/* ===================================================================================================== */




export function getIntersect( PM , NODE )
{
	//console.log( TG.arrMARKS )
	let intersects
	let intersects2
	raycaster.setFromCamera( PM, camera );	//raycaster

// BIEN FAIRE ATTENTION raycaster.intersectObjects (tableau objet) != intersectObject (1seul objet)
	intersects = raycaster.intersectObject( NODE );// detection sur le terrain
	if ( intersects.length > 0 ) 
	{
		PTR_Helper.position.set( 0, 0, 0 );
		PTR_Helper.lookAt( intersects[ 0 ].face.normal )
		PTR_Helper.position.copy( intersects[ 0 ].point ); // 
	}// detection sur objet terran
	
	if ( terran.arrMARKS ) 
	{ 
		intersects2 = raycaster.intersectObjects( terran.arrMARKS ); 
		if ( intersects2.length > 0 ) 
		{
			intersects2[ 0 ].object.material.color.setHex( Math.random() * 0xffffff );
			return intersects
		}
	} // detection sur objet repere mark
	
return -1
}


//---------------------------------------------------------------------------------------------------------------------------



/**
 * Créer un pointeur de souris ( cone ) , il est ajoute a la scene
 * evolution passer la scenen en parametre ??
 * @param {Integer} HP Hauteur du pointeur
 * @param {Integer} RP Rayon du pointeur
 */
function sct_addPointer( HP, RP )
{
	//const tempH = Math.min(TILW,TILH) / 15;//on adapte le cone a la dimension des tiles
	//const tempR = tempH / 4;
	//let geometryHelper = new THREE.ConeBufferGeometry( RP , HP, 10 ); // obsolete
	//radius,height,radialSegments
	const geometryHelper =  new THREE.ConeGeometry( RP , HP, 10 );
	geometryHelper.translate( 0, -HP/2, 0 ); //positionne au 0 de y car le cone est centre par defaut
	geometryHelper.rotateX( -Math.PI );
	PTR_Helper = new THREE.Mesh( geometryHelper, new THREE.MeshNormalMaterial() );
	scene.add( PTR_Helper );

}


/* ===================================================================================================== */


window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

/* ------------------------------------------------------------------------------------------- */
    const person1 = new ENTITY.Person( { firstname: "John", lastname: "Doe", birthdate: "1990-05-15" } )
    console.log(person1.getAge())                   // Affiche l'âge de la personne
    console.log(person1.getWarningBirthday(7))      // avertissement si anniv est dans les 7 jours

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();

renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

const controls = new OrbitControls(camera, renderer.domElement);// Contrôles caméra

raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();






// Cube
const geometry = new THREE.BoxGeometry();

const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
const material2 = getMaterialFromTextures(0)


const cube = new THREE.Mesh(geometry, material);
scene.add(cube);

const geometry2 = new THREE.BoxGeometry();
const cube2 = new THREE.Mesh(geometry2, material2);
cube2.position.x = 0.5;cube2.position.y = -2.5;cube2.position.z = 0.5;
scene.add(cube2);

/* gestion du terain */
const terran = new TerranGenerator(60, 60, 30, 30)
terran.fillPlanar(2, -2)
//terran.setPlaneColor()
terran.addMarks(scene); // ajoute les cubes rouges

const terranMesh = terran.getMesh();
terranMesh.rotateX( - Math.PI/2 ) 		//on applique la rotation ue seule fois ici 
scene.add(terranMesh);



let ambient= new THREE.AmbientLight( 0xffffff , 2 )
scene.add( ambient )


sct_addPointer( 20 , 5) //pointeur de souris

camera.position.z = 2;





let clock = new THREE.Clock();
const start = Date.now();

// gestion event raycasting
const cont3js = document.body; // const cont3js = document.getElementById( 'container' );
cont3js.addEventListener( 'mousemove', onMouseMove, false );


/*  --------------------------------------  */

function animate() {
    requestAnimationFrame(animate);
	
	controls.update(); // obligatoire si enableDamping = true
	
    cube.rotation.x += 0.01;
    cube.rotation.y += 0.01;
	
    renderer.render(scene, camera);
	
	console.log( t3js_RealtimeToSimultime() );
}




animate();
</script>

</body>
</html>