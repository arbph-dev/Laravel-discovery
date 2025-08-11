/**
 * 03/05/24 -   cretion
 * 04/05/   -   evolution gestion de 

 */


        /*
        gerer les 
            types / categorie et catgoeire parent electrecitie/resistance
            affichage display   =>  qui conditionne l'apparence 
            param               => propre au symbole R, U, I , P peuvent se calculer
            identif               => propre au matériel mrque ,modele ean 13
            etats 
        */
const symbolPropertySet = [
    { name: 'x', type: 'number', description: 'position horizontale', defaultValue: 0 },
    { name: 'y', type: 'number', description: 'position verticale', defaultValue: 0 },
    { name: 'width', type: 'number', description: 'largeur', defaultValue: 100 },
    { name: 'height', type: 'number', description: 'hauteur', defaultValue: 26 },
    { name: 'color', type: 'text', description: 'couleur', defaultValue: 'black' },
    { name: 'resistance', type: 'text', description: 'résistance', defaultValue: '' },
    { name: 'voltage', type: 'text', description: 'tension', defaultValue: '' },
    { name: 'current', type: 'text', description: 'courant', defaultValue: '' },
    { name: 'power', type: 'text', description: 'puissance', defaultValue: '' },
    { name: 'brand', type: 'text', description: 'marque', defaultValue: '' },
    { name: 'model', type: 'text', description: 'modèle', defaultValue: '' },
    { name: 'marque', type: 'text', description: 'marque du composant', defaultValue: '' },
    { name: 'ean13', type: 'text', description: 'code barre', defaultValue: '' }
];

export class Symbol {
    static uid = 0; // Variable de classe pour générer des IDs uniques


    constructor(properties = {}) {
        
        // Initialisation avec les valeurs par défaut
        for (const property of symbolPropertySet) {
            this[property.name] = (properties[property.name] !== undefined) ? properties[property.name] : property.defaultValue;
        }

        // Assignation d'un ID unique à chaque instance
        this.uid = Symbol.uid++;

    }

    getName() { return 'uid:'+ this.uid }

    getPropertiesTable() 
    {
        const table = document.createElement("table");
        table.border = "1";
        
        // entete
        let row = table.insertRow();
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        let cell4 = row.insertCell(3);

        cell1.style.padding = "10px"; cell1.style.margin = "10px"; cell1.textContent = "name";
        cell2.style.padding = "10px"; cell2.style.margin = "10px"; cell2.textContent = "description";
        cell3.style.padding = "10px"; cell3.style.margin = "10px"; cell3.textContent = "type";
        cell4.style.padding = "10px"; cell4.style.margin = "10px"; cell4.textContent = "Valeur";
        // uid
        row = table.insertRow();
        cell1 = row.insertCell(0);
        cell2 = row.insertCell(1);
        cell3 = row.insertCell(2);
        cell4 = row.insertCell(3);

        cell1.style.padding = "10px"; cell1.style.margin = "10px"; cell1.textContent = "uid";
        cell2.style.padding = "10px"; cell2.style.margin = "10px"; cell2.textContent = "identifiant unique";
        cell3.style.padding = "10px"; cell3.style.margin = "10px"; cell3.textContent = "number";
        cell4.style.padding = "10px"; cell4.style.margin = "10px"; cell4.textContent = this.uid;


        for (const property of symbolPropertySet) {
            row = table.insertRow();
            cell1 = row.insertCell(0);
            cell2 = row.insertCell(1);
            cell3 = row.insertCell(2);
            cell4 = row.insertCell(3);

            cell1.style.padding = "10px";
            cell1.style.margin = "10px";
            cell1.textContent = property.name;

            cell2.style.padding = "10px";
            cell2.style.margin = "10px";
            cell2.textContent = property.description;

                       
            //cell3.style = cell1.style; //bug ???
            cell3.style.padding = "10px";
            cell3.style.margin = "10px";
            cell3.textContent =  property.type

            cell4.style.padding = "10px";
            cell4.style.margin = "10px";
            cell4.textContent =  this[property.name];
            
        }
    
        return table;

    }

    //prevoir une option displayvalues
    draw(ctx) {
        ctx.fillStyle = this.color;
        ctx.fillRect(this.x, this.y, this.width, this.height);

        // Dessiner les valeurs
        ctx.fillStyle = 'black';
        ctx.font = '12px Arial';
        ctx.fillText( this.getName(), this.x, this.y - 20);
        /*
        ctx.font = '10px Arial';
        ctx.fillText('R: ' + this.resistance, this.x, this.y - 10);
        ctx.fillText('U: ' + this.voltage, this.x, this.y );
        ctx.fillText('I: ' + this.current, this.x, this.y + 10);
        ctx.fillText('P: ' + this.power, this.x, this.y + 20);
        */

        //ctx.fillText('Marque: ' + this.brand, this.x, this.y + 20);
        //ctx.fillText('Modèle: ' + this.model, this.x, this.y + 30);
//debugger
        this.ean13 = 12560
        console.log(this.ean13)
    }

    isPointInside(x, y) {
        return x >= this.x && x <= this.x + this.width && y >= this.y && y <= this.y + this.height;
    }
}
