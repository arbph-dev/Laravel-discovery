
/*

    cwCT : contneneaur utile pour le code html text etc c'est le node a mettre a jour append html ou append nide
*/

import * as IHM from '../ihm.js'

export class ModalWin 
{
    #modal_DIV = 'cp_modal_div'    // contient tous les div dela modale (a cahcher ou afficher)
    #modal_TI = 'cp_modal_ti' // div affichant titre de la modale
    #modal_TITLE = ''
    #modal_CL = 'cp_modal_cl'
    // this.mwin_TITLE // variable titre
    #modal_CT = 'cp_modal_ct'
    #modal_HTMLCODE = '' //par defauit
    
    //--------------------------------------------------------
    /** Conbstructeur de la classe
     * @param {*} TITLE titre avec valeur par defaut
     * @param {*} CODEHTML cotneu html avec valeur par defaut
     */
    constructor( TITLE = "Titre de la fenetre modale" , CODEHTML = "<h2>Fenetre modaldiv</h2>Ajouter le code" ) 
    {
        this.#modal_TITLE = TITLE ; this.setTitle_Html( this.#modal_TITLE )
        this.#modal_HTMLCODE = CODEHTML ; this.setContent_Html( CODEHTML )

        const CWModalClose = document.getElementById( this.#modal_CL );// CWModalClose.innerText = 'X' peut evoluer vers html et svg ??
        if ( CWModalClose != null )
        {           
            CWModalClose.addEventListener('click', ( event ) => { this.hide() } )
        }
    }

    //--------------------------------------------------------
    /**affiche la modale*/
    show() { let modal = document.getElementById( this.#modal_DIV ) ; modal.style.display = "block" }
    
    //--------------------------------------------------------
    /**cache la modale*/
    hide() { let modal = document.getElementById( this.#modal_DIV ) ; modal.style.display = "none" }
    
    //--------------------------------------------------------
    /** affecte un titre
     * @param {string} HTMLTITLE
     * @returns NONE 
     */
    setTitle_Html( HTMLTITLE ) { IHM.CONTENT_SetHtml( this.#modal_TI , HTMLTITLE ) }

    //--------------------------------------------------------
    setContent_Html( HTMLCODE = this.#modal_HTMLCODE ) { IHM.CONTENT_SetHtml( this.#modal_CT , HTMLCODE ) }

    //--------------------------------------------------------
    setContent_Node( NODE ) { if ( NODE != null) { IHM.CONTENT_setChild( this.#modal_CT , NODE ) }
    }

    //--------------------------------------------------------


}
