/**
 * gestion synthese vocale - vocxTwo
 * 
 * 31/12/2023 : création
 * 01/05/2024 : modification pour gestion des callbacks
 * 01/01/2025 : ajout gestion des événements start, end, boundary, et error
 */

const DEBUG = true; // niveaux de débogage
const DEBUG2 = false;



export function MakeHtml(arr , arrIdx  ){ 
    let htmlString = ''
    let htmlWord = ''

    for(let j=0; j < arr.length ;j++)
        {
        
        if ( j == arrIdx ) { htmlWord = '<b>' + arr[j] + '</b>' } else { htmlWord = arr[j] }

        if ( j < arr.length - 1 ) { htmlString+= htmlWord + " " } else { htmlString+= htmlWord }   

        }

    return htmlString
}



export class Vox {
  //  static #SV_OBJ = null;            // objet synthèse vocale
    static #SV_STATE = -1;            // état initial (non initialisé)
    static #SV_VOICES_COLL = [];      // collection de  SpeechSynthesisVoice  https://developer.mozilla.org/en-US/docs/Web/API/SpeechSynthesisVoice 
    // Déclaration des champs privés
    static #SV_TTS = "";
    static #SV_WORDCOUNT = 0;
    static #SV_WORDLCI = 0;
    static #SV_WORDS = [];
    static #SV_OBJ = speechSynthesis; // Instance globale


    static #SV_MSG_FR_COLL = [
        'Bonjour, je suis en état de fonctionner.',
        'Comment allez-vous ?',
        'Comment vous appelez-vous ?'
    ];

    static #SV_MSG_EN_COLL = [
        'Hello, it is operating.',
        'How are you?'
    ];

    constructor() {}

    /**
     * Vérifie les possibilités logicielles
     */
    static getCaps() {
        
        if (window.speechSynthesis) {
            
            this.#SV_STATE = 0 // synthèse vocale disponible
            this.#SV_OBJ = window.speechSynthesis

            this.#SV_OBJ.addEventListener("voiceschanged", (event) => 
                {
                console.log(`vocxTwo.js: cb Event voiceschanged => name ${event.name}.`)
                this.#SV_STATE = 1
                console.log(`vocxTwo.js: getCaps, voiceschanged => getVoices`)
                this.#SV_VOICES_COLL = this.#SV_OBJ.getVoices()
                }
            )
            
            console.log(`vocxTwo.js: getCaps, direct => getVoices`)
            this.#SV_VOICES_COLL = this.#SV_OBJ.getVoices() 


        }
        else { this.#SV_STATE = -2 } // non disponible

        return this.#SV_STATE
    }

    /**
     * Renvoie une chaîne avec les infos des voix
     */
    static getSpeechInfo() {
        const infos = this.#SV_VOICES_COLL.map(voice => 
            `${voice.name} (${voice.lang}) URI: ${voice.voiceURI} local: ${voice.localService} default: ${voice.default}`
        ).join('\n');

        return infos;
    }

    /**
     * Teste la synthèse vocale avec un message
     * @param {Function} callback Callback pour notifier les événements
  
    static testVoices(callback) {
        if (this.#SV_STATE >= 0) {
            const utter = new SpeechSynthesisUtterance(this.#SV_MSG_FR_COLL[0]);
            utter.voice = this.#SV_VOICES_COLL.find(voice => voice.lang === "fr-FR") || this.#SV_VOICES_COLL[0];

            // Événement déclenché au démarrage de la synthèse vocale
            utter.addEventListener("start", (event) => {
                console.log("vocxTwo.js: Synthèse vocale démarrée.");
               // callback && callback("start");
            });

            // Événement déclenché à la fin de la synthèse vocale
            utter.addEventListener("end", (event) => {
                console.log(`vocxTwo.js: Synthèse vocale terminée après ${event.elapsedTime || "N/A"} secondes.`);
                //callback && callback("end");
            });

            // Événement déclenché à chaque limite détectée (mot, pause, etc.)
            utter.addEventListener("boundary", (event) => {
                console.log(`vocxTwo.js: Limite détectée. 
                    Nom: ${event.name || "Inconnu"}, 
                    Temps écoulé: ${event.elapsedTime || "N/A"} secondes.`);
                //callback && callback("boundary");
            });

            // Événement déclenché en cas d'erreur
            utter.addEventListener("error", (event) => {
                console.error(`vocxTwo.js: Erreur de synthèse vocale. 
                    Erreur: ${event.error || "Inconnue"}, 
                    Temps écoulé: ${event.elapsedTime || "N/A"} secondes.`);
                //callback && callback("error");
            });

            // Lancement de la synthèse vocale
            this.#SV_OBJ.speak(utter);
        }
    }
   */
    static Speak(
    TTS = "Bonjour, le module de synthèse vocale est actif.",
    callbacks = { start: null, end: null, boundary: null, error: null }
    ) 
    {
        let utter_Temp = new SpeechSynthesisUtterance(TTS);
        this.#SV_TTS = TTS;
        this.#SV_WORDCOUNT = 0;
        this.#SV_WORDLCI = 0;
        this.#SV_WORDS = this.#SV_TTS.split(" ");
//-------------------------        
        utter_Temp.voice = this.#SV_VOICES_COLL[1];


        utter_Temp.rate = 0.8; // It can range between 0.1 (lowest) and 10 (highest), with 1 being the default rate
        utter_Temp.volume = 1;

        this.#SV_OBJ.speak(utter_Temp);

        // Ajout des gestionnaires d'événements en fonction des callbacks
        if (callbacks.start) {
            utter_Temp.addEventListener("start", callbacks.start);
        }

        if (callbacks.end) {
            utter_Temp.addEventListener("end", callbacks.end)

        }

        if (callbacks.error) {
            utter_Temp.addEventListener("error", callbacks.error);
        }

        if (callbacks.boundary) {
            utter_Temp.addEventListener("boundary", (event) => {

                    if (DEBUG === true) {
                        console.log(
                            `vocx.js: cb Event boundary => name ${event.name} temp ${event.elapsedTime} charIndex ${event.charIndex}.`
                        );
                    }
                    //lors d ela lecture on voit plusieurs event avec le meme charindex ici on filtre pour compter les mots correctment
                    if ( event.name == "word" ) {
                        if ( event.charIndex > this.#SV_WORDLCI ) { this.#SV_WORDCOUNT++; }
                        this.#SV_WORDLCI = event.charIndex
                    }
                


                // Appel du callback boundary pour externaliser la mise à jour du DOM
                      callbacks.boundary(
                        { 
                            event,
                            formattedText: MakeHtml( this.#SV_WORDS ,this.#SV_WORDCOUNT ),
                            wordCount: this.#SV_WORDCOUNT 
                        }

                    ); ////formattedText: FormattedTTS,
  
            });
        }


    }

}
