fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.talent-container');
        
        data.models.forEach(model => {
            const card = document.createElement('section');
            card.classList.add('talent-container2');
            
            card.innerHTML = `
                <div class="talent-text-container">
                    <div class="talent-title"><h2>${model.name}</h2></div>
                    <div class="talent-main-text">
                        <h3>height: ${model.height || 'N/A'} waist: ${model.waist || 'N/A'}</h3><br>
                        <h3>location: ${model.location || 'N/A'}</h3>
                    </div>
                    <div class="talent-sub-text"><p>${model.description || ''}</p></div>
                    <div class="btn person-btn" id="person-btn"><a href="${model.profileLink}" target="_blank"> see more</a></div>
                </div>
                <div class="talent-img">
                    <a href="${model.profileLink}" target="_blank"><img src="${model.image}" alt="${model.name}"></a>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading JSON data:', error));
