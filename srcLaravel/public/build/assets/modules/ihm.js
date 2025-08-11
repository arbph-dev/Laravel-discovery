/**
 * module ihm
 * 2025-05-25 : repris version courant eporu essai laravel
 * 2024-01-15 : revue et ajout des function CONTENT_SetHtml CONTENT_appendHtml CONTENT_setChild CONTENT_appendChild
 * 2323-12-21 : suppresion des debug ; remplacer dans touts les arguments de fonction true par false
 * 2023-12-25 : validation de la creation image
 */
// import * as DAT from './data' // 2025-05-25 pas de ref au modolu et a eviter directement

export function win_get_screen(DBG = false)
{

    if (DBG){ Debug( "ihm.js" , "win_get_screen " , "=> Start "  ); }    /* #DBG */

    //documente rutilisation de smap
    //a voir pour strutcutre rect
    const kvArray = [
        ["n", "ecran 0 (par defaut)"],
        ["x", screen.availLeft],
        ["y", screen.availTop],
        ["w", screen.availWidth],
        ["h", screen.availHeight]
      ];


    if (DBG){ Debug( "ihm.js" , "win_get_screen " , "=> End "  ); }    /* #DBG */
    return kvArray;
    
}


export function win_asyncget_screen( fnc, DBG = false)
{

    if (DBG){ Debug( "ihm.js" , "win_get_screen " , "=> Start "  ); }    /* #DBG */

    //documente rutilisation de smap
    //a voir pour strutcutre rect
    const kvArray = [
        ["n", "ecran 0 (par defaut)"],
        ["x", screen.availLeft],
        ["y", screen.availTop],
        ["w", screen.availWidth],
        ["h", screen.availHeight]
      ];

    CONTENT_Show( 'infoTemp' );
    CONTENT_SetHtml('infoTemp' , 'Andrea')
    CONTENT_Info('infoTemp');
      
    fnc();//apple la callback passe ne pointeur


    if (DBG){ Debug( "ihm.js" , "win_get_screen " , "=> End "  ); }     /* #DBG */
    return kvArray;
    
}


//--------------------------------------------------------------------------------------------------------------------------------------------------
let activeCT = '';
/**Affiche en masquant les autres contenu
 * voir let activeCT = '';
 * cette variable permet de savori quell e onglet est actif 
 * 
 * @param {String} CTDIVID id du bloc div, p du document html a afficher voir positionnement css
 * @param {boolean} DBG pour le debugage si necessaire
 * 
 */
export function CONTENT_Show( CTDIVID , DBG = false)
{
    
    if (DBG){ Debug( "ihm.js" , "CONTENT_Show " , "=> Start "  ); }/* #DBG */
    
    let divCT;

        if( activeCT != '' )
        {
            divCT = window.document.getElementById(activeCT);divCT.style.display = "none";
        }
		divCT = window.document.getElementById(CTDIVID );divCT.style.display = "block";
		activeCT =CTDIVID ;

    if (DBG){ Debug( "ihm.js" , "CONTENT_Show " , "=> End "  ); }    /* #DBG */
}

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Affiche sans masquer les autres contenu
 * @param {String} CTDIVID 
 * @param {boolean} DBG 
 */
export function CONTENT_Display( CTDIVID ) { let divCT= window.document.getElementById(CTDIVID ) ; divCT.style.display = "block"; }   

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Masque sans afficher les autres contenu
 * @param {String} CTDIVID id du div a cahcer
 */
export function CONTENT_Hide( CTDIVID ) { let divCT= window.document.getElementById(CTDIVID ) ; divCT.style.display = "none"; }

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Remplace le contenu, affecte CTHTMLCODE au noeud CTDIVID
 * @param {string} CTDIVID id du div a mettre a jour
 * @param {string} CTHTMLCODE cod ehtml a afficher
 */
export function CONTENT_SetHtml( CTDIVID , CTHTMLCODE ) { let divCT = window.document.getElementById(CTDIVID ); divCT.innerHTML = CTHTMLCODE; }

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Ajoute le contenu CTHTMLCODE au noeud CTDIVID
  * @param {*} CTDIVID id du div a mettre a jour
 * @param {*} CTHTMLCODE cod ehtml a ajouter
 */
export function CONTENT_appendHtml( CTDIVID , CTHTMLCODE ) { let divCT = window.document.getElementById(CTDIVID ); divCT.innerHTML += CTHTMLCODE; }

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Ajoute un noeud CHILDNODE au noeud CTDIVID
 * @param {*} CTDIVID id du div a mettre a jour
 * @param {*} CHILDNODE noeud ou ensemble de noeud a ajouter voir CreateNode_xxx
 */
export function CONTENT_appendChild( CTDIVID , CHILDNODE ) { let divCT = window.document.getElementById(CTDIVID ) ; divCT.appendChild(CHILDNODE); }

//--------------------------------------------------------------------------------------------------------------------------------------------------
/** Remplace le contenu et affecte un noeud CHILDNODE au noeud CTDIVID
 * @param {*} CTDIVID 
 * @param {*} CHILDNODE 
 */
export function CONTENT_setChild( CTDIVID , CHILDNODE ) { let divCT = window.document.getElementById(CTDIVID ) ; divCT.innerHTML = "" ; divCT.appendChild(CHILDNODE) }



//--------------------------------------------------------------------------------------------------------------------------------------------------
export function BODY_appendChild_text_P( textP , DBG = false )
{
//    if (DBG){ Debug( "ihm.js" , "CONTENT_appendChild " , "=> Start "  ); }
    const elmP = document.createElement("P") 
    elmP.innerHTML = textP
    document.body.appendChild(elmP);
    if (DBG){ Debug( "ihm.js" , "CONTENT_appendChild " , "=> End "  ); }
}





/** AddControl sert de fonction de test
 * bug avec before ??
 * @param {string} CTDIV id du div recevant le songlets
 */
export function AddControl( CTDIV )
{
    AddImage( CTDIV , "PIC1" , "./media/images/CLASSES/voiture.jpg" , "une voiture rose" , 200, 200)

}
//----------------------------------------------------------------------------------------------------
/**
 * Modifie la classe d'un noeud
 * 20240116 mise a jour suite SetNode_Attribute
 *    // let NODETEMP = window.document.getElementById( IDN )
   // NODETEMP.setAttribute( "class" , CLN)
 * 
 * 
 * 
 * @param {*} IDN 
 * @param {*} CLN 
 */
export function SetNode_Class( IDN , CLN ) { setNode_Attribute( IDN , 'class' ,  CLN) }

/**
 * prevoir une verison avec un tableau
 * @param {*} IDN 
 * @param {*} ATT 
 * @param {*} VAL 
 */
export function setNode_Attribute( IDN , ATT , VAL ) { let NODETEMP = window.document.getElementById( IDN ); NODETEMP.setAttribute( ATT , VAL) }
//attention différent  de node.value
export function getNode_Attribute( IDN , ATT  ) { let NODETEMP = window.document.getElementById( IDN ); return NODETEMP.getAttribute(ATT) }



//----------------------------------------------------------------------------------------------------
/** Créer un noeud  DIV 
 * @param {string} NDVID 
 * @param {string} NDVCLASS 
 * @param {string} NDVCODHTML 
 */
export function CreateNode_Div( NDVID = null , NDVCLASS = null , NDVCODHTML = null )
{
    let NODEDIV = document.createElement( "div" ) 
    let ATTRSPAN
    if ( NDVID != null) { ATTRSPAN = document.createAttribute("id") ; ATTRSPAN.value = NDVID ; NODEDIV.setAttributeNode(ATTRSPAN) }
    if ( NDVCLASS != null) { ATTRSPAN = document.createAttribute("class") ; ATTRSPAN.value = NDVCLASS ;NODEDIV.setAttributeNode(ATTRSPAN) }
    if ( NDVCODHTML != null) { NODEDIV.innerHTML = NDVCODHTML }
    return NODEDIV
}
//------------------------------------------------------------------------------------------------
/**
   dvMNUITEM = document.createElement( "span" )
 * @param {*} NDVID 
 * @param {*} NDVCLASS 
 * @param {*} NDVCODHTML 
 * @returns 
 */
export function CreateNode_Span( NDVID = null , NDVCLASS = null , NDVCODHTML = null )
{
    let NODESPAN = document.createElement( "span" )
    let ATTRSPAN 

    if ( NDVID != null)
        {
        ATTRSPAN = document.createAttribute("id")
        ATTRSPAN.value = NDVID 
        NODESPAN.setAttributeNode(ATTRSPAN)
        }

    if ( NDVCLASS != null)
        {
        ATTRSPAN = document.createAttribute("class")
        ATTRSPAN.value = NDVCLASS
        NODESPAN.setAttributeNode(ATTRSPAN)
        }

    if ( NDVID != null)
        {
            NODESPAN.innerHTML = NDVCODHTML
        }

    return NODESPAN
}
//------------------------------------------------------------------------------------------------






//--------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * Ajoute une image à un Noeud
 * un niveau d'abstraction est nécessaire
 * 
 * @param {string} CTDIV identifiant ID du noeud a etendre
 * @param {string} IDPIC identifiant de l'image
 * @param {string} SRC chemin du fichier
 * @param {string} ALT description de l'image
 */
export function AddImage( CTDIV , IDPIC , SRC , ALT , W , H ) { CONTENT_appendChild( CTDIV , CreateNode_Image( IDPIC , SRC , ALT , W , H ) ) }
//--------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * construit une liste non ordonnée
 * voir <i class="fa-li fa fa-spinner fa-spin"> a ajouter en nodepour puce animée
 * https://fontawesome.com/v4/examples/
 * @returns UL node
 * 
 * 
 */
function CreateNode_UL()
{
    let ul  = document.createElement('ul')
    let li
    let txt
    let att
    let i

    for (i =0 ; i < 8 ;i++)
    {
      	
      	li  = document.createElement('li')
      	txt = document.createTextNode( 'index : ' + i )
      	li.appendChild(txt)
      	li.addEventListener("click", (evt) =>{ console.log(evt) })
        att = document.createAttribute("id")
        att.value = "li" + i // Set the value of the id attribute:
        li.setAttributeNode(att) // Add the id attribute to an element:
		ul.appendChild(li)
	}
    console.log(ul)
    return ul;
}
//--------------------------------------------------------------------------------------------------------------------------------------------------

export function CreateNode_TEXTAREA( IDTA="ZoneTexte" , COLS="40" , ROWS="20" )
{
    let txt = document.createElement("TEXTAREA" )
    let att = document.createAttribute("id") ; att.value = IDTA; txt.setAttributeNode(att)
    att = document.createAttribute("cols") ; att.value = COLS; txt.setAttributeNode(att)
    att = document.createAttribute("rows") ; att.value = ROWS; txt.setAttributeNode(att)
    let t = document.createTextNode("At w3schools.com you will learn how to make a website.");
    txt.appendChild(t);
    console.log(txt)
    return txt;
}
//--------------------------------------------------------------------------------------------------------------------------------------------------
//SRC = "./media/images/blank.jpg"
//a mettr ene constante de configuration
/*
CreateNode_Image2 pour test ne renvoie pa sles valeurs attendues et methode "non DOM" conserve pour manipulation d'images ??
https://developer.mozilla.org/fr/docs/Web/API/HTMLCanvasElement
*/

function CreateNode_Image2( IDPIC = "MonImage", SRC = "./media/images/blank.jpg", ALT = "Description de l'image" , W = -1 , H = -1) {
    let myImage = new Image();
    // 400 / 200 = 2
    myImage.src = SRC;
    myImage.alt = ALT;
    myImage.id = IDPIC

    /* abandonné cause lecture des valeurs renvoie 0  tant que non affichee => a gerer en amont
    console.log(myImage);
    console.log(typeof(myImage.width));
    console.log(myImage.width);console.log(myImage.naturalWidth);
    console.log(myImage.height);
    let rWH = parseFloat( parseInt(myImage.width) / parseInt(myImage.height) )

    if ( rWH > 1 )
        {
            myImage.height = parseInt(200 / rWH)
            myImage.width = W
        }
    else
        {
            myImage.height = H
            myImage.width = parseInt(200 * rWH)
        }*/
    return myImage;
}

/**
 * Ajoute une image(noeud) à un Noeud
 *  
 * @param {string} IDPIC identifiant ID de image
 * @param {string} SRC chemin depuis lma racine
 * @param {string} ALT description de l'image
 * @param {Integer} W largeur affichage  de l'image
 * @param {Integer} H hauteur affichage  de l'image
 * 
 * @returns NODE HtmlImageElement
 */
export function CreateNode_Image( IDPIC = "MonImage", SRC = "./media/images/blank.jpg", ALT = "Description de l'image" , W = -1 , H = -1) {
    let img = document.createElement("img");
    let att = document.createAttribute("id"); att.value = IDPIC; img.setAttributeNode(att);
    att = document.createAttribute("src"); att.value = SRC;img.setAttributeNode(att);
    att = document.createAttribute("alt"); att.value = ALT; img.setAttributeNode(att);

    //if ( ( W === -1 ) && ( H === -1 ) ) {} // il ne faut rien ajouter
    if ( ( W != -1 ) && ( H === -1 ) ) { att = document.createAttribute("width"); att.value = W;img.setAttributeNode(att); }
    if ( ( W === -1 ) && ( H != -1 ) ) { att = document.createAttribute("height"); att.value = H;img.setAttributeNode(att);}
    if ( ( W != -1 ) && ( H != -1 ) ) 
        { 
            att = document.createAttribute("width"); att.value = W; img.setAttributeNode(att);
            att = document.createAttribute("height"); att.value = H;img.setAttributeNode(att);
        }
    console.log(img);
    return img;
}

//.ctImg_Left
export function CreateNode_ctLeftImage( IDPIC = "MonImage", SRC = "./media/images/blank.jpg", ALT = "Description de l'image" , W = -1 , H = -1) {
    let img = document.createElement("img");
    let att = document.createAttribute("id"); att.value = IDPIC; img.setAttributeNode(att);
    att = document.createAttribute("src"); att.value = SRC;img.setAttributeNode(att);
    att = document.createAttribute("alt"); att.value = ALT; img.setAttributeNode(att);
    att = document.createAttribute("class"); att.value = 'ctImg_Left'; img.setAttributeNode(att);

    //if ( ( W === -1 ) && ( H === -1 ) ) {} // il ne faut rien ajouter
    if ( ( W != -1 ) && ( H === -1 ) ) { att = document.createAttribute("width"); att.value = W;img.setAttributeNode(att); }
    if ( ( W === -1 ) && ( H != -1 ) ) { att = document.createAttribute("height"); att.value = H;img.setAttributeNode(att);}
    if ( ( W != -1 ) && ( H != -1 ) ) 
        { 
            att = document.createAttribute("width"); att.value = W; img.setAttributeNode(att);
            att = document.createAttribute("height"); att.value = H;img.setAttributeNode(att);
        }
    console.log(img);
    return img;
}


/* function en TEST doit déterminer le sdimensiosn et propréités d'une image */
function getDetails_Image() { }

//--------------------------------------------------------------------------------------------------------------------------------------------------

/**
 * Ajoute un bouton(noeud) à un Noeud
 a faire evoluer avec pointeur de fonction 
 * @param {string} IDBT identifiant ID de bouton
 * @param {string} TXT texte affiché sur le bouton

 * @returns NODE HtmlButtonElement
 */

export function CreateNode_Button( IDBT="BTN" , TXT="Bouton BTN")
{
    let bt = document.createElement("button" )
    let att = document.createAttribute("id") ; att.value = IDBT; bt.setAttributeNode(att)
    let t = document.createTextNode(TXT); bt.appendChild(t);
    bt.addEventListener("click", (evt) =>{ console.log(evt) })

    console.log(bt)
    return bt;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------
/**
 * voir pour sauvegarder les donnnes ??
 * 
 * 
 * @param {string} CTDIV identifiantt de la zone div pour affichage
 */
export function AddLink( CTDIV) { DAT.RequestXHRdata( "rawdata.txt" , CTDIV ) }

//20240113    
//ne fonctionne pas caus ele retour est asynchorne
/*
export function AddLink2( CTDIV) { 
    DAT.RequestJsonHttp( "./data/rawdata.txt" , CTDIV , Format_Link) 
}
*/

/**
 * callback de AddLink, formatte les données et les renvoie pour traiement, afficage
 * @param {*} linksRESP 
 * @returns 
 */
export function Format_Link( linksRESP) { 
        //console.log(' module ihm ligne XXX : Format_Link ')
        let links = JSON.parse(linksRESP) 
        let out = "<h2>Liens</h2>";
        let i;
 
        for(i = 0; i < links.length; i++) { out += '<a href="' + links[i].url + '">' + links[i].display + '</a><br>'; }
        //console.log(out)
        return out;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------

/* a améliorer pour afficher des donnes */
export function CONTENT_Info( CTDIVID , DBG = false ){
    let divCT;

    divCT = window.document.getElementById(CTDIVID );
    if (DBG){  /* #DBG */
        Debug( "ihm.js" , "CONTENT_Info " , `Attributs ; ${divCT.attributes.length} ; Enfants : ${divCT.childNodes.length} `  ); 


        console.log(divCT);
    }   

}
//--------------------------------------------------------------------------------------------------------------------------------------------------

export function Debug( dbg_file , dbg_func , dbg_text )
{
    console.log(` ; ${dbg_file} ; ${dbg_func} ; ${dbg_text}` );
}

//--------------------------------------------------------------------------------------------------------------------------------------------------



/*
DECHETS 

    //console.log(ListProperty( window ) ) ;
    //console.log(Object.getOwnPropertyNames(window));
    CONTENT_Show( 'infoTemp' );
    //CONTENT_SetHtml( 'infoTemp' , Object.getOwnPropertyNames(window) );
    //CONTENT_SetHtml( 'infoTemp' , Object.getOwnPropertyNames(entries) ); //ne fct pas
   

    const obj = Object.fromEntries(entries);
    console.log("; ihm.js ; CONTENT_SetHtml => Object.fromEntries(entries)");
    console.log(entries);//*

// CONTENT_SetHtml( 'infoTemp' , Object.getOwnPropertyNames(entries[0]) );//bug au pasage du module
//caus einconnue entries pas dans le scope => a passer en argument
//---------------------------------------------------------------
  var x = document.createElement("TEXTAREA");
  var t = document.createTextNode("At w3schools.com you will learn how to make a website.");
  x.appendChild(t);
  document.body.appendChild(x);

    var ul  = document.createElement('ul');
    var li;
    var txt;

    for (i =0 ; i < 8 ;i++)
    {
      	
      	li  = document.createElement('li');
      	txt = document.createTextNode( 'index : ' + i );
      	li.appendChild(txt);
      	li.addEventListener("click", UL_EventListener);
		ul.appendChild(li);
	}
    
    OTEMP.appendChild(ul);
}
const att = document.createAttribute("href");
att.value = "https://www.w3schools.com";// Set the value of the href attribute:
element.setAttributeNode(att);// Add the href attribute to an element:

function UL_EventListener( evt )
{
alert(evt.target.innerHTML);
}

*/