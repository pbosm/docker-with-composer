function loadChart() {
    api.get({
        function: 'TreeMapController/loadChart'
    }).then(response => {
        $('.x-loader').fadeOut();

        if (response.status == 'success') {
            console.log(response.data);
            drawTreeMap(response.data);
        } 

        if (response.status == 'error') {
            return;
        } 
    }).catch(error => {
        showError('Erro interno', error);
    });
}

function drawTreeMap(data) {
    const container = document.getElementById('chartTreemap');
    const tooltip = document.getElementById('tooltip');
    const totalPoints = data.reduce((acc, item) => acc + item.points, 0);
    const width = container.offsetWidth;
    const height = 1200;

    function drawRects(data, x, y, w, h) {
        let remainingData = [...data];
        let currentY = y;
        
        // Calcular a altura de cada linha
        const rowHeight = height / Math.ceil(data.length / (width / 100)); // altura da linha ajustada para o número de dados

        while (remainingData.length > 0) {
            let rowWidth = 0;
            let currentX = x;
            let rowData = [];
            
            // Dividir os dados em linhas para garantir uma melhor distribuição
            for (let item of remainingData) {
                const itemWidth = (item.points / totalPoints) * width;
                rowWidth += itemWidth;

                // Se a linha ultrapassar a largura total, parar
                if (currentX + itemWidth > x + width) break;

                rowData.push(item);
                currentX += itemWidth;
            }

            // Desenhar a linha
            currentX = x;
            rowData.forEach((item) => {
                const itemWidth = (item.points / totalPoints) * width;
                const tile = document.createElement('div');
                tile.className = 'tile';
                tile.style.left = `${currentX}px`;
                tile.style.top = `${currentY}px`;
                tile.style.width = `${itemWidth}px`;
                tile.style.height = `${rowHeight}px`;
                tile.style.backgroundColor = 'steelblue';
                tile.style.lineHeight = `${rowHeight}px`;
                tile.style.textAlign = 'center';
                tile.innerText = item.team;
                tile.dataset.name = item.team;
                tile.dataset.value = item.points;

                tile.addEventListener('mouseover', (e) => {
                    tooltip.style.display = 'block';
                    tooltip.innerHTML = `Team: ${e.target.dataset.name}<br>Points: ${e.target.dataset.value}`;
                    tooltip.style.left = `${e.pageX + 5}px`;
                    tooltip.style.top = `${e.pageY - 28}px`;
                });

                tile.addEventListener('mouseout', () => {
                    tooltip.style.display = 'none';
                });

                container.appendChild(tile);

                currentX += itemWidth;
            });

            currentY += rowHeight;
            remainingData = remainingData.slice(rowData.length); // Remover dados processados
        }
    }

    drawRects(data, 0, 0, width, height);
}
















