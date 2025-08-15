ajout de vue dans resources/views/three.blade.php

ajout d'une route three pour essai threejs

```php
Route::get('/three', function () {  return view('three');});
```

On ajoute le lien dans le menu => welcome.blade.php

welcome.blade.php exploite le layout/pure.blade.php

<x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>
remplacé par 
<x-nav.link2 href="/three" :active="request()->is('three')">Threejs</x-nav.link2>

on prévoit de reprndre le code existant comme la classe TerranGenerator dans C:\wamp64\www\W3D5\js\modules\3js\3jsMNT.js


## Classes
### TerranGenerator
manque: 
fonction getMaterialFromTextures
fonction getRandomArbitrary
a sortir style des marqueurs 

```js
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
```



<!-- 
a voir
            var XT = 0;var YT =0; // coordonnées tile
            var XP = 0;var YP = 0; // coordonées carte texture
            var XG = 0;var YG = 0; // coordonées geo depuis point d ecarte
            var TEXGEO_DX;
            var TEXGEO_DY;

            const TILW = 240;
            const TILH = 100;
            const TILSW = 20;
            const TILSH = 20;
            const TILW2 = TILW / 2; //double usage avec worldHalfWidth ligne50
            const TILH2 = TILH / 2;

/* CALLBACK appeleé au chargment d'une texture pour garder le sinfos de l'image*/
function cbTEX_Loaded( tex ) 
{ 
	TEXW = tex.image.width; //recupere largeur image texure
	TEXGEO_DX = TEXW / (TEXXE - TEXXO);//calcule elratio LARG image / etdenue geo ouest-est
	TEXH = tex.image.height;
	TEXGEO_DY = TEXH / (TEXYS - TEXYN);

	console.log(getDistanceFromLatLonInKm(TEXXO,TEXYN,TEXXE,TEXYS));
}

function Coord_TileToMap( IntersectVec )
{

    XT = IntersectVec.x + TILW2;YT = IntersectVec.z + TILH2;//console.log("position tile x " + XT + " y " + YT );
    XP = TEXW / TILW * XT;YP = TEXH / TILH * YT;//console.log("position image x " + XP + " y " + YP );
    XG = TEXXO + (XP / TEXGEO_DX ); YG = TEXYN + (YP /TEXGEO_DY );  //position geo
    var sTemp = "The X axis is red. The Y axis is green. The Z axis is blue<br/>";
    sTemp += "position image x " + XP.toFixed(0) + " y " + YP.toFixed(0) + "<br/>";
    sTemp += "position geo x " + XG.toFixed(4) + " y " + YG.toFixed(4);
    CONTENT_SetHtml( 'infoWorld' , sTemp );
}


-->
