//2025-05-22 : ajout de constnate pour la configuration à placer dans code page





// const mySidebarId = "mySidebar";
// const myOverlayId = "myOverlay";
// const myDbgbarId = "myDebugbar";


// derniere fonction appelée
// point entrée app
let State_Doc_Loaded = false;


function AppendDebug( strFunct, strOut , strRow = 0  )
{
if ( (State_Doc_Loaded === true) && (myDbgbar != null ) )
  {
  myDbgbar.innerHTML += `Debug == ${strFunct} ; à la ligne : ${strRow} Message  ${strOut} <br>`;
  }
}









window.addEventListener("load", (event) => {
    State_Doc_Loaded = true;
    console.log( "laramain.js / evt listener :  load\n") ;

    // 2025-05-20 : ajout pour RWD
    brw_info();
    AppendDebug("laramain.js / window.addEventListener load" , " Javascript, etat OK (init, load successeed )");

    //2025-05-26 ajout svg
    path = document.getElementById('lissajous-path'); 
    //init necessaire il faudra gere la valeur de path dans animate
    // si null on affecte , teste ensuite si nok continue sinon return
    if (path) 
      { 
        animate();
        AppendDebug("laramain.js / animate is starting, svg anim will run");
      }
    else { AppendDebug("⚠️ lissajous-path introuvable."); }




//2025-05-25 pour gestion callout dom

    document.querySelectorAll('.callout .titre').forEach(titre => {
        titre.addEventListener('click', () => {
            const contentId = titre.id.replace('_TITRE', '_CONTENT');
            const contentDiv = document.getElementById(contentId);
            contentDiv.style.display = contentDiv.style.display === 'none' || contentDiv.style.display === '' ? 'block' : 'none';
        });
    });



});


document.addEventListener("readystatechange", (event) => {
    console.log( `laramain.js / evt listener :  readystate: ${document.readyState}\n` ) ;
  switch (document.readyState) {   
    case "interactive": {   console.log(" Loading wait ..");break;}
    case "complete": {   console.log(" Loaded ..");break;}        
  }    
});

document.addEventListener("DOMContentLoaded", (event) => {
    console.log(`laramain.js / evt listener :  DOMContentLoaded\n`);
  mySidebar = document.getElementById(mySidebarId); // initilaise les vaibales de ihm
  overlayBg = document.getElementById(myOverlayId); // initilaise les vaibales de ihm
  myDbgbar = document.getElementById(myDbgbarId); // initilaise les vaibales de ihm
});
            

//----------------------------------------------------------------------------------------
// const mySidebarId = "mySidebar";
// const myOverlayId = "myOverlay";

let mySidebar;// Get the Sidebar
let overlayBg;// Get the DIV with overlay effect
let myDbgbar;// Get the debugbar


function w3_open() {
  console.log(`laramain.js / w3_open()\n`);
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';overlayBg.style.display = "block";
  }
}

function w3_open2() {
  console.log(`laramain.js / w3_open()\n`);
  if (myDbgbar.style.display === 'block') {
    myDbgbar.style.display = 'none';overlayBg.style.display = "none";
  } else {
    myDbgbar.style.display = 'block';overlayBg.style.display = "block";
  }
}

function w3_close() {
  console.log(`laramain.js / w3_close()\n`);
  mySidebar.style.display = "none"; overlayBg.style.display = "none";
}

function w3_close2() {
  console.log(`laramain.js / w3_close()\n`);
  myDbgbar.style.display = "none"; overlayBg.style.display = "none";
}



let brw_W; // window.innerWidth
let brw_H; // window.innerHeight
let brw_WH; // window.innerWidth / window.innerHeight
let brw_ACN; //navigator.appCodeName
let brw_AN; 
let brw_AV; 
let brw_CE; 
let brw_OS; 
let brw_UA; 

function brw_info()
{
console.log(`laramain.js / brw_info() => infos  navigateur\n`);
brw_W = window.innerWidth;
brw_H = window.innerHeight;
brw_WH = brw_W / brw_H;
console.log(`window Width ${brw_W} x Height ${brw_H} ratio ${brw_WH} \n`  );

brw_ACN = navigator.appCodeName;
console.log( `navigator.appCodeName : ${brw_ACN}\n` ) ;

brw_AN = navigator.appName;
console.log( `navigator.appCodeName : ${brw_AN}\n` ) ;

brw_AV = navigator.appVersion;
console.log( `navigator.appVersion : ${brw_AV}\n` ) ;

brw_CE = navigator.cookieEnabled;
console.log( `navigator.cookieEnabled : ${brw_CE}\n` ) ;

brw_OS = navigator.platform;
console.log( `navigator.platform : ${brw_OS}\n` ) ;

brw_UA = navigator.userAgent;
console.log( `navigator.userAgent : ${brw_UA}\n` ) ;


}



//-----------------------------------------------------------------------------


    // Gestion du svg 

    const svgWidth = 150;
    const svgHeight = 150;
    //const path = document.getElementById('curve');
    
    // let path = document.getElementById('lissajous-path');//
    let path; // paht ne peut etre initialisé avant chargment du dom on deplace l'init d ela var dans la fonction looad du doc 


    // Paramètres de la courbe
    const A = 60; // Amplitude X
    const B = 60; // Amplitude Y
    const delta = Math.PI / 2; // Déphasage
    let a = 3; // Fréquence initiale X
    let b = 2; // Fréquence initiale Y

    // Paramètres de variation
    const stepPHI = Math.PI / 1800; // Pas pour faire varier le déphasage (0 à 360°)
    const ratioFmin = 1; // Fréquence minimale pour Y
    const ratioFmax = 10; // Fréquence maximale pour Y
    const stepF = 0.01; // Pas pour faire varier la fréquence

    let currentDelta = 0; // Initialisation du déphasage à 0
    let currentFreqX = a; // Initialisation de la fréquence X
    let currentFreqY = b; // Initialisation de la fréquence Y

    function generateLissajous(a, b, delta) {
      const points = [];
      const step = 0.02; // Précision
      for (let t = 0; t <= 2 * Math.PI; t += step) {
        const x = svgWidth / 2 + A * Math.sin(a * t + delta);
        //const y = offX + ( svgWidth / 2 + A * Math.sin(a * t + delta) );
        const y = svgHeight / 2 + B * Math.sin(b * t);
        const svgx = x + 885;
        const svgy = y;
        //const x = offY + ( svgHeight / 2 + B * Math.sin(b * t) );
        points.push(`${svgx},${svgy}`);
//        points.push(`${x},${y}`);
      }
      return points.join(' ');
    }

    /*
    function animate() {
      a += 0.1; // Modifier la fréquence X pour l'animation
      path.setAttribute('d', `M ${generateLissajous(a, b, delta)}`);
      requestAnimationFrame(animate);
    }
    */
    function animate() {
      // Faire varier le déphasage
      currentDelta += stepPHI;  // Déphasage augmente avec chaque frame
      
      if (currentDelta >= 2 * Math.PI) {
        currentDelta = 0; // Réinitialiser le déphasage à 0 après un cycle complet (360°)

        // Faire varier les fréquences à chaque retour à 0 du déphasage
        currentFreqY += stepF;
        if (currentFreqY > ratioFmax) currentFreqY = ratioFmin; // Réinitialiser ou limiter la fréquence X

        //currentFreqY = currentFreqX * 0.6; // Moduler la fréquence Y par rapport à X (exemple de ratio)
      }

      // Générer la nouvelle courbe avec le déphasage et les fréquences modifiés
      path.setAttribute('d', `M ${generateLissajous(currentFreqX, currentFreqY, currentDelta)}`);

      // Appeler à nouveau l'animation
      requestAnimationFrame(animate);
    }