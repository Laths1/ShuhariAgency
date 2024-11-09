fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        
        let person;
        if (id.startsWith("model")) {
            person = data.models.find(model => model.id === id);
        } else if (id.startsWith("editor")) {
            person = data.editors.find(editor => editor.id === id);
        } else if(id.startsWith("photographer")){
            person = data.photographers.find(photographer => photographer.id === id);
        } else if (id.startsWith("designer")){
            person = data.designers.find(designer => designer.id === id);
        } else if(id.startsWith("videographer")){
            person = data.videographers.find(videographer => videographer.id === id);
        }

        if (person) {
            // Display name and bio
            document.querySelector('.name').innerText = person.name;
            document.querySelector('.bio').innerText = person.description;
            
            // Display each image in a simple list layout
            const imagesContainer = document.querySelector('.images-container'); 
            person.images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                imgElement.alt = `${person.name}`;
                imgElement.style.width = "100%"; // Adjust the size as needed
                imagesContainer.appendChild(imgElement);
            });
        } else {
            console.error("Profile not found.");
        }
    })
    .catch(error => console.error('Error loading JSON data:', error));
