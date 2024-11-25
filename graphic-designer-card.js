fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.talent-container');
        
        data.designers.forEach(designer => {
            const card = document.createElement('section');
            card.classList.add('talent-container2');
            
            card.innerphp = `
                <div class="talent-text-container">
                    <div class="talent-title"><h2>${designer.name}</h2></div>
                    <div class="talent-main-text">
                        
                        <!--<h3>location: ${designer.location || 'N/A'}</h3>-->
                    </div>
                <!-- <div class="talent-sub-text"><p>${designer.description || ''}</p></div> -->
                    <div class="btn person-btn" id="person-btn"><a href="${designer.profileLink}"> view</a></div>
                </div>
                <div class="talent-img">
                    <a href="${designer.profileLink}"><img src="${designer.image}" alt="${designer.name}"></a>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading JSON data:', error));
