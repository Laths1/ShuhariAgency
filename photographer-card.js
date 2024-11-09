fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.talent-container');
        
        data.photographers.forEach(photographer => {
            const card = document.createElement('section');
            card.classList.add('talent-container2');
            
            card.innerHTML = `
                <div class="talent-text-container">
                    <div class="talent-title"><h2>${photographer.name}</h2></div>
                    <div class="talent-main-text">
                        <!--<h3>height: ${photographer.height || 'N/A'} waist: ${photographer.waist || 'N/A'}</h3><br>-->
                        <h3>location: ${photographer.location || 'N/A'}</h3>
                    </div>
                   <!-- <div class="talent-sub-text"><p>${photographer.description || ''}</p></div> -->
                    <div class="btn person-btn" id="person-btn"><a href="${photographer.profileLink}" > view</a></div>
                </div>
                <div class="talent-img">
                    <a href="${photographer.profileLink}" ><img src="${photographer.image}" alt="${photographer.name}"></a>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading JSON data:', error));
