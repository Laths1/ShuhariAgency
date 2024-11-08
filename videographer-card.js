fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.talent-container');
        
        data.videographers.forEach(videographer => {
            const card = document.createElement('section');
            card.classList.add('talent-container2');
            
            card.innerHTML = `
                <div class="talent-text-container">
                    <div class="talent-title"><h2>${videographer.name}</h2></div>
                    <div class="talent-main-text">
                        <!--<h3>height: ${videographer.height || 'N/A'} waist: ${videographer.waist || 'N/A'}</h3><br>-->
                        <h3>location: ${videographer.location || 'N/A'}</h3>
                    </div>
                    <!--<div class="talent-sub-text"><p>${videographer.description || ''}</p></div>-->
                    <div class="btn person-btn" id="person-btn"><a href="${videographer.profileLink}" target="_blank"> view</a></div>
                </div>
                <div class="talent-img">
                    <a href="${videographer.profileLink}" target="_blank"><img src="${videographer.image}" alt="${videographer.name}"></a>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading JSON data:', error));
