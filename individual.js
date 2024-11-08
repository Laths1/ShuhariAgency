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
        }

        if (person) {
            document.querySelector('.name').innerText = person.name;
            document.querySelector('.bio').innerText = person.bio;
            
            const carouselContainer = document.querySelector('.carousel');
            person.images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                carouselContainer.appendChild(imgElement);
            });
        } else {
            console.error("Profile not found.");
        }
    })
    .catch(error => console.error('Error loading JSON data:', error));
