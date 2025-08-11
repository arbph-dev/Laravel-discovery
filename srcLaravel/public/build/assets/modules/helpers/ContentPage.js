import * as IHM from '../ihm.js'


export class CtPage 
{
    #pg_DIV = null //nom de vi acceuillant la page
    pg_name = null //nom de la page


    constructor( DIVAMIN , PGNAME , PGCONTENT )
    {
        if ( ( DIVAMIN === null ) || ( PGNAME === null ) ) { console.log('class CtPage , DIVAMIN or PGNAME is null'); return }
        
        this.#pg_DIV = DIVAMIN 
        this.pg_name = PGNAME
        console.log('class CtPage , PAGE is set, div is on cosntruction');
        //IHM.CONTENT_SetHtml( this.#tab_DIV , "class TabsCtrl , start in progress." )
        this.initFrame(PGCONTENT)

    }

    evt_Click( evt )
    {
        console.log( 'CtPage <= evt_Click '+ evt )
        console.log( evt )
    }

    evt_MMove( evt )
    {
        console.log( 'CtPage <= evt_MMove '+ evt )
        console.log( evt )
    }


    initFrame( CONTENT )
    {
        let dvCTPG = IHM.CreateNode_Div( 
            this.pg_name ,
            'CtPageBlock',
            CONTENT
            )
        dvCTPG.addEventListener("click", ( evt ) => { this.evt_Click( evt ) })
        dvCTPG.addEventListener("mousemove", ( evt ) => { this.evt_MMove( evt ) })
        IHM.CONTENT_appendChild(this.#pg_DIV , dvCTPG) 
    }

    setContentHTML( HTMLCODE) 
    { 
        let idFRMSEL = this.pg_name
        IHM.CONTENT_SetHtml( idFRMSEL , HTMLCODE ) 
    }
    
    setContentNode( NODE ) 
    { 
        let idFRMSEL = this.pg_name
        IHM.CONTENT_setChild( idFRMSEL , NODE ) 
    }

    appendContentHTML( HTMLCODE) 
    { 
        let idFRMSEL = this.pg_name
        IHM.CONTENT_appendHtml( idFRMSEL , HTMLCODE ) 
    }

    appendContentNODE( NODE) 
    { 
        let idFRMSEL = this.pg_name
        IHM.CONTENT_appendChild( idFRMSEL , NODE ) 
    }



    getNode()
    {
        return document.getElementById( this.#pg_DIV )

    }



}
