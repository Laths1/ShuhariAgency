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
        } else if (id.startsWith("photographer")) {
            person = data.photographers.find(photographer => photographer.id === id);
        } else if (id.startsWith("designer")) {
            person = data.designers.find(designer => designer.id === id);
        } else if (id.startsWith("videographer")) {
            person = data.videographers.find(videographer => videographer.id === id);
        }

        if (person) {
            // Display name and bio
            document.querySelector('.name').innerText = person.name;
            document.querySelector('.bio').innerText = person.description;
            
            // If the person is a model, display extra details
            if (id.startsWith("model")) {
                const detailsContainer = document.querySelector('.details');
                detailsContainer.innerHTML = `
                    <p>Height: ${person.height || 'N/A'}</p>
                    <p>Waist: ${person.waist || 'N/A'}</p>
                    <p>Shoe Size: ${person.shoeSize || 'N/A'}</p>
                `;
            }

            // Display location for certain types
            if (id.startsWith("photographer") || id.startsWith("videographer") || id.startsWith("model")) {
                const location = document.querySelector('.location');
                location.innerHTML = `<p>Location: ${person.location || 'N/A'}</p>`;
            }

            // Display each image in a simple list layout
            if(id.startsWith("photographer") || id.startsWith("designer") || id.startsWith("model")){
                const imagesContainer = document.querySelector('.images-container'); 
                person.images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                imgElement.alt = `${person.name}`;
                // imgElement.style.width = "100%"; // Adjust the size as needed
                imagesContainer.appendChild(imgElement);
            });
            }

            // If the person is a videographer, display their videos
            if (id.startsWith("editor") || id.startsWith("videographer")  && person.videos) {
                const videosContainer = document.querySelector('.videos-container');
                
                person.videos.forEach(videoUrl => {
                    const iframeElement = document.createElement('iframe');
                    iframeElement.src = videoUrl;
                    iframeElement.width = "100%";
                    iframeElement.height = "315"; // Adjust the height as needed
                    iframeElement.frameBorder = "0";
                    iframeElement.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                    iframeElement.allowFullscreen = true;

                    videosContainer.appendChild(iframeElement);
                });
            }
        } else {
            console.error("Profile not found.");
        }
    })
    .catch(error => console.error('Error loading JSON data:', error));
