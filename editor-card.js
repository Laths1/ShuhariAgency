fetch('cardData.json')
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.talent-container');
        
        data.editors.forEach(editor => {
            const card = document.createElement('section');
            card.classList.add('talent-container2');
            
            card.innerHTML = `
                <div class="talent-text-container">
                    <div class="talent-title"><h2>${editor.name}</h2></div>
                    <div class="talent-main-text">
                        <!--<h3>height: ${editor.height || 'N/A'} waist: ${editor.waist || 'N/A'}</h3><br>-->
                        <!--<h3>location: ${editor.location || 'N/A'}</h3>-->
                    </div>
                    <!--<div class="talent-sub-text"><p>${editor.description || ''}</p></div>-->
                    <div class="btn person-btn" id="person-btn"><a href="${editor.profileLink}" target="_blank"> view</a></div>
                </div>
                <div class="talent-img">
                    <a href="${editor.profileLink}" target="_blank"><img src="${editor.image}" alt="${editor.name}"></a>
                </div>
            `;

            container.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading JSON data:', error));
