// MODULES --------------------------------------------------------------------------------------------------------
import * as ENTITY from './modules/entity.js'
import {ModalWin} from './modules/helpers/modalwin.js';
/*import { ImageCarousel } from './public/build/assets/carousel.js'; */
import { ImageCarousel } from './carousel.js';

import * as IHM from './modules/ihm.js'//2025-06-21

import * as VOX from './modules/vocxTwo.js';//2025-06-21//2025-05-30 //sent by ftp 



// CONSTANTES -------------------------------------------------------------------------------------------------
const cp_nav_divnavId = "Esf_Navbar" //Esf_Navbar
const cp_nav_overlayId = "cp_nav-overlay"
const cp_dbg_divId = "cp_dbg-div"

//variable ssur les noeeuds du document
let cp_nav_divnav // ref a div nav.cp_nav_divnav ligne 62   du dom 
let cp_nav_overlay
let cp_dbg_div

// gestion etat
let State_Doc_Loaded = false; // etat du document charge (tout load => ok)

//application
let person1 = null; // person1 = new ENTITY.Person( { firstname: "John", lastname: "Doe", birthdate: "1990-05-15" } )
let MYMODALWIN; // MYMODALWIN = new ModalWin("Titre de modale")

//---------------------------------------------------------------------------------------------------------------------------
// gestion du theming a documenter et finir
let flagTheming= true // light


window.myFunction = () => {
    
    let bodyElement = document.body; bodyElement.classList.toggle("body_dark-mode")
    let headerElement = document.getElementById("Esf_Header"); headerElement.classList.toggle("Esf_Header_dark-mode")
    let footerElement = document.getElementById("Esf_Dnbar"); footerElement.classList.toggle("Esf_Dnbar_dark-mode")
    let btElement = document.getElementById("si_bt-Theming")

    if (flagTheming === true)
      { btElement.innerHTML = "Light mode" ; flagTheming = false }
    else
      { btElement.innerHTML = "Dark mode" ; flagTheming = true }

    AppendDebug('simple_script.js / myFunction' , 'gestion du theming a documenter et finir' , 47 ) 
}

//------------------------------------------------------------------------------------
// Systeme, chargmeent DOM effectué  mais le document n'est pas encore chargé
// il faut attendre initialisation complete du dom avant de les affecter sinon null

document.addEventListener("DOMContentLoaded", (event) => {
    console.log(`simple_script.js / evt listener :  document.DOMContentLoaded\n`);
    //init variable de test passer par le controleur
    cp_nav_divnav = document.getElementById( cp_nav_divnavId ); // initilaise les vaibales de ihm
    cp_nav_overlay = document.getElementById( cp_nav_overlayId ); // initilaise les vaibales de ihm
    cp_dbg_div = document.getElementById( cp_dbg_divId ); // initilaise les vaibales de ihm
});

//--------------------------------------------
// CALLBACK des gestionnaires event 
// compte tenu des utilisations depuis modules on doit prevoir 
// des callback global a limté et revoir

//------------------------------------------------------------------------------------------------------------------
// ferme le div Esf_Navbar sur mobile a ajouter dans le menu
// <div class="cp_nav-overlay" id="cp_nav-overlay" onclick="w3_close()"></div>
window.w3_close = () => { 
    AppendDebug('pure_script.js / window.w3_open' , 'Fermeture div navigation ' , 69 )    
    cp_nav_divnav.style.display = "none";
    cp_nav_overlay.style.display = "none";
}
//------------------------------------------------------------------------------------------------------------------
// ouvre le div Esf_Navbar sur mobile
// <a href="javascript:void(0);" class="sys-item" onclick="w3_open()" title="Toggle Navigation Menu" ><i>&#9776;</i></a>
window.w3_open = () => {
    AppendDebug('pure_script.js / window.w3_open' , 'Ouverture div navigation ' , 75 )    
    if (cp_nav_divnav.style.display === 'block') { cp_nav_divnav.style.display = 'none' ; cp_nav_overlay.style.display = "none" }
    else { cp_nav_divnav.style.display = 'block'; cp_nav_overlay.style.display = "block" }
}

//------------------------------------------------------------------------------------------------------------------
// ferme le div cp_dbg-div sur mobile
window.w3_close2 = () => { 
    cp_dbg_div.style.display = "none"
    AppendDebug('simple_script.js / window.w3_close2' , 'Fermeture page debug ' , 65 )
} 
//------------------------------------------------------------------------------------------------------------------
// ouvre le div cp_dbg-div sur mobile
//<a href="javascript:void(0)" onclick="w3_open2()">debug</a>
window.w3_open2 = () => {
    AppendDebug("simple_script.js / window.w3_open2" , " Ouverture page debug" , 76 )

  if (cp_dbg_div.style.display === 'block') {
    cp_dbg_div.style.display = 'none'
  }
  else {
    cp_dbg_div.style.display = 'block'
  }
}


//-----------------------------------------------------------

  function infoTemp_bt1_ev_click( evt ) { 
    TestEntity_Person() 
    IHM.AddImage("card1-div1", "PIC4" , "./public/img/ANIMAUX/CHIENS/berger-allemand.jpg" , "un chien comme son toutou" , 200, 200)
  }

//-------------------------------------------------------
  function card_bt2_ev_click( evt ) { 
  
    AppendDebug('simple_script.js / card_bt2_ev_click' , 'Appui sur le bouton. ' , 106)
    testSV()
  }


  //-------------------------------------------------------
  // lit le contenu du callout et le parle
  function card_bt3_ev_click( evt ) { 
  
    AppendDebug('simple_script.js / card_bt3_ev_click' , 'Appui sur le bouton. ' , 115 )
    const textsrc_obj = document.getElementById( "CALLOUT_2_CONTENT")

    if ( textsrc_obj != null )
    {
      AppendDebug('simple_script.js / card_bt3_ev_click' , textsrc_obj.innerText , 115 )

      if (VOX.Vox.getCaps() >= 0 )
      { 
        AppendDebug('simple_script.js / card_bt3_ev_click' , VOX.Vox.getSpeechInfo() , 124 )
        VOX.Vox.Speak(textsrc_obj.innerText)
      }
      else
      { 
        AppendDebug('simple_script.js / card_bt3_ev_click' , "WARN : SV not installed" , 124 )
      }

    }

    



  }

//------------------------------------------------------------------
// Treeview
//doit etre affecte a window pour etre appelele depusi HTML
// doit etre une fonction anomyne

//affiche masque un element
window.TreeCmp_toggle = (element) => {
    const node = element.parentElement;
    const children = node.querySelector('.TreeCmp_children');

    if (!children) return;

    if (children.classList.contains('TreeCmp_hidden')) {
        children.classList.remove('TreeCmp_hidden');
        element.textContent = '▼';
    } else {
        children.classList.add('TreeCmp_hidden');
        element.textContent = '▶';
    }
}
//affiche masque tous les elements
window.TreeCmp_toggleAll = () => {
    const btn = document.getElementById('TreeCmp_toggleAll');
    const expand = btn.dataset.state !== 'expanded';

    document.querySelectorAll('.TreeCmp_children').forEach(el => {
        el.classList.toggle('TreeCmp_hidden', !expand);
    });

    document.querySelectorAll('.TreeCmp_toggle').forEach(el => {
        el.textContent = expand ? '▼' : '▶';
    });

    btn.textContent = expand ? 'Tout replier' : 'Tout déplier';
    btn.dataset.state = expand ? 'expanded' : 'collapsed';
}

//------------------------------------------------------------------


/**
 *  SYNTHESE VOCALE
 */
function testSV() { 

       if (VOX.Vox.getCaps() >= 0 )
            { 
            console.log( VOX.Vox.getSpeechInfo())
            }
        else
            { 
              console.log( "WARN : SV not installed" )
           }

        console.log(VOX.Vox)



  VOX.Vox.Speak("Je m'appelle Soren.", {
    start: () => console.log("Début de la lecture."),
    end: () => console.log("Fin de la lecture."),
    error: (err) => console.error("Erreur :", err),
    boundary: ({ formattedText, wordCount }) => {
            console.log(`Mots lus : ${wordCount}`);
            console.log(`formattedText : ${formattedText}`);
            document.getElementById( "card1-div1").innerHTML = formattedText;

    },
  });


}  


/**
 * 
 */

/*
export function evaluateCode(id) {
    const code = document.querySelector(`#CODEVAL_${id} .scriptcode textarea`).value;
    const resultDiv = document.querySelector(`#CODEVAL_${id} .result`);
    resultDiv.style.display = 'block';
    try {
        const result = eval(code);
        resultDiv.textContent = `Résultat : ${result}`;
    } catch (error) {
        resultDiv.textContent = `Erreur : ${error.message}`;
    }
}
*/




window.evaluateCode = (id) => {
    const code = document.querySelector(`#CODEVAL_${id} .scriptcode textarea`).value;
    const resultDiv = document.querySelector(`#CODEVAL_${id} .result`);
    resultDiv.style.display = 'block';
    try {
        const result = eval(code);
        resultDiv.textContent = `Résultat : ${result}`;
    } catch (error) {
        resultDiv.textContent = `Erreur : ${error.message}`;
    }
}


//------------------------------------------------------------------

window.addEventListener('load', () => {
    State_Doc_Loaded = true
    cp_dbg_div.innerHTML = ''; // reset du contenu variable pointeur DOM cp_dbg_div,  referencé par cp_dbg_divId  ( "cp_dbg-div" )
    //console.log('simple_script.js / evt listener :  window.load');
    AppendDebug('simple_script.js / window.load' , 'Document chargé ' , 112)


    path = document.getElementById('lissajous-path'); //init necessaire il faudra gere la valeur de path dans animate
    // si null on affecte , teste ensuite si nok continue sinon return
    if (path) { 
        animate(); AppendDebug('simple_script.js / window.load' , 'animate() est lancé, anim svg' , 122)
      }
    else { AppendDebug('simple_script.js / window.load' , '⚠️ lissajous-path introuvable. ' , 124)}



// en cours    
//    TestEntity_Person()

//on devrait conserver la reference au listenre pour les supprimer en mode gestion par fonction voir cele manager

    const infoTemp_bt1 = document.getElementById( "card-bt1");
      if ( infoTemp_bt1 != null )
      {
            infoTemp_bt1.addEventListener('click', ( event ) => { infoTemp_bt1_ev_click( event ) } ) 
      }  

    const card_bt2 = document.getElementById( "card-bt2");
      if ( card_bt2 != null )
      {
            card_bt2.value="mon bouton 2"
            card_bt2.addEventListener('click', ( event ) => { card_bt2_ev_click( event ) } ) 
      }
      
    const card_bt3 = document.getElementById( "card-bt3");
      if ( card_bt3 != null )
      {
            card_bt3.value="lecture callout"
            card_bt3.addEventListener('click', ( event ) => { card_bt3_ev_click( event ) } ) 
      }
      
    //2025-06-21 gestion callout  
    document.querySelectorAll('.cp_callout .titre').forEach(titre => {
        titre.addEventListener('click', () => {
            const contentId = titre.id.replace('_TITRE', '_CONTENT');
            const contentDiv = document.getElementById(contentId);
            contentDiv.style.display = contentDiv.style.display === 'none' || contentDiv.style.display === '' ? 'block' : 'none';
        });
    });

    // Gestion des blocs Eval
    document.querySelectorAll('.cp_codeval .titre').forEach(titre => {
        titre.addEventListener('click', () => {
            const parent = titre.parentElement;
            const scriptCode = parent.querySelector('.scriptcode');
            const result = parent.querySelector('.result');
            scriptCode.style.display = scriptCode.style.display === 'none' || scriptCode.style.display === '' ? 'block' : 'none';
            result.style.display = 'none';
        });
    });

});





// utilitaires
function AppendDebug( strFunct, strOut , strRow = 0  )
{
if ( (State_Doc_Loaded === true) && (cp_dbg_div != null ) )
  {
  cp_dbg_div.innerHTML += `Debug == ${strFunct} ; à la ligne : ${strRow} Message  ${strOut} <br>`;
  }
 
}




//-----------------------------------
//essai module

function TestEntity_Person()
{
    person1 = new ENTITY.Person( { firstname: "John", lastname: "Doe", birthdate: "1990-05-15" } )
    console.log(person1.getAge())                   // Affiche l'âge de la personne
    console.log(person1.getWarningBirthday(7))      // avertissement si anniv est dans les 7 jours
    AppendDebug( 'simple_script / TestEntity_Person' , person1.getPropertiesTable() , 133 )

    testMM( person1 ) //affiche modal, exploite data de person1
}


// essai fenetre  modal
//
function testMM( PERS1 ) { 
    MYMODALWIN = new ModalWin("Titre de modale")
    MYMODALWIN.setContent_Node( PERS1.getPropertiesTable() )
    MYMODALWIN.show()
}


//------------------------
// animation svg
//* 80*80 */




    // Gestion du svg 

    const svgWidth = 360;
    const svgHeight = 80;
    //const path = document.getElementById('curve');
    
    // let path = document.getElementById('lissajous-path');//
    let path; // paht ne peut etre initialisé avant chargment du dom on deplace l'init d ela var dans la fonction looad du doc 


    // Paramètres de la courbe
    const A = 40; // Amplitude X
    const B = 40; // Amplitude Y
    const delta = 2 * Math.PI; // Déphasage
    let a = 1; // Fréquence initiale X
    let b = 0.5; // Fréquence initiale Y

    // Paramètres de variation
    const stepPHI = Math.PI / 360; // Pas pour faire varier le déphasage (0 à 360°)
    const ratioFmin = 0.5; // Fréquence minimale pour Y
    const ratioFmax = 2; // Fréquence maximale pour Y
    const stepF = 0.05; // Pas pour faire varier la fréquence

    let currentDelta = 0; // Initialisation du déphasage à 0
    let currentFreqX = a; // Initialisation de la fréquence X
    let currentFreqY = b; // Initialisation de la fréquence Y

    function generateLissajous(a, b, delta) {
      const points = [];
      const step = 0.0005; // Précision

      for (let t = 0; t <= (2 * Math.PI)/Math.min(a,b); t += step) {
        const y = svgHeight / 2 + B * Math.sin( 2 * Math.PI * b * t + delta); // u  =U sin wt w = 2 pi f
        const x = svgWidth / 2 + A * Math.sin(2 * Math.PI * a * t);
        const svgx = x;
        const svgy = y;
        //const x = offY + ( svgHeight / 2 + B * Math.sin(b * t) );
        points.push(`${svgx},${svgy}`);
//        points.push(`${x},${y}`);
      }
      return points.join(' ');
    }


    function animate() {
      // Faire varier le déphasage
      currentDelta += stepPHI;  // Déphasage augmente avec chaque frame
      
      if (currentDelta >=  Math.PI) {
        currentDelta = -Math.PI ; // Réinitialiser le déphasage à 0 après un cycle complet (360°)

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