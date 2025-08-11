//module entity

// Définition de la classe Person

  // Objet propertySet pour décrire les propriétés de la classe
  const personPropertySet = [
    { name: 'firstname', type: 'text', description: 'Prénom' },
    { name: 'lastname', type: 'text', description: 'Nom' },
    { name: 'birthdate', type: 'text', description: 'Date de naissance' }
  ];


export class Person {
/**
 * 
 * 
    constructor(firstname, lastname, birthdate) {
      this.firstname = firstname;
      this.lastname = lastname;
      this.birthdate = birthdate;
    }
 */
    constructor(properties) {
        // Initialiser les propriétés de la classe en fonction de l'objet propertySet
        for (const property of personPropertySet) {
          this[property.name] = properties[property.name];
        }
      }


    // Méthode pour calculer l'âge de la personne
    getAge() {
      const today = new Date();
      const birthdate = new Date(this.birthdate);
      let age = today.getFullYear() - birthdate.getFullYear();
      const monthDiff = today.getMonth() - birthdate.getMonth();

      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
        age--;
      }

      return age;
    }

    // Méthode pour obtenir un avertissement si l'anniversaire est dans le délai spécifié
    getWarningBirthday(delay) {
      const today = new Date();
      const birthdate = new Date(this.birthdate);
      const nextBirthday = new Date(today.getFullYear(), birthdate.getMonth(), birthdate.getDate());

      if (nextBirthday < today) {
        nextBirthday.setFullYear(today.getFullYear() + 1);
      }

      const daysUntilBirthday = Math.ceil((nextBirthday - today) / (1000 * 60 * 60 * 24));

      if (daysUntilBirthday <= delay) {
        return `Attention : L'anniversaire de ${this.firstname} ${this.lastname} est dans ${daysUntilBirthday} jours!`;
      } else {
        return null;
      }
    }

        // Méthode pour générer un formulaire avec les propriétés de la personne
    generateForm() {
        const form = document.createElement("form");
    
        for (const property of personPropertySet) {
            form.innerHTML += `
            <label for="${property.name}">${property.description}:</label>
            <input type="${property.type}" id="${property.name}" value="${this[property.name]}" readonly><br>
            `;
        }
    
        // Ajouter le champ d'âge et d'avertissement anniversaire au formulaire
        form.innerHTML += `
            <label for="age">Âge:</label>
            <input type="text" id="age" value="${this.getAge()}" readonly><br>
    
            <label for="warning">Avertissement anniversaire:</label>
            <input type="text" id="warning" value="${this.getWarningBirthday(7) || 'Pas d\'avertissement'}" readonly><br>
        `;
    
        return form;
        }

    getPropertiesTable() {
        const table = document.createElement("table");
        table.border = "1";
    
        for (const property of personPropertySet) {
            const row = table.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);

            cell1.style.padding = "10px";
            cell1.style.margin = "10px";
            cell1.textContent = property.description;

            cell2.style.padding = "10px";
            cell2.style.margin = "10px";
            cell2.textContent = property.type;

                       
            //cell3.style = cell1.style; //bug ???
            cell3.style.padding = "10px";
            cell3.style.margin = "10px";
            cell3.textContent = this[property.name];
            
        }
    
        return table;
        }


// Nouvelle méthode pour afficher l'instance avec du style
    view() {
        const container = document.createElement("div");
        container.style.border = "2px solid #ccc";
        container.style.padding = "10px";
        container.style.margin = "10px";
        container.style.borderRadius = "5px";

        const title = document.createElement("h2");
        title.textContent = "Détails de la Personne";
        title.style.color = "#333";
        title.style.textDecoration = "underline";
        container.appendChild(title);

        const details = document.createElement("div");
        details.innerHTML = `
        <strong>Prénom:</strong> ${this.firstname}<br>
        <strong>Nom:</strong> ${this.lastname}<br>
        <strong>Date de naissance:</strong> ${this.birthdate}<br>
        <strong>Âge:</strong> ${this.getAge()}<br>
        <strong>Avertissement anniversaire:</strong> ${this.getWarningBirthday(7) || 'Pas d\'avertissement'}
        `;
        container.appendChild(details);

        return container
    }


  }
