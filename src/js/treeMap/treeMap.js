function loadChart() {
    api.get({
        function: 'TreeMapController/loadChart'
    }).then(response => {
        $('.x-loader').fadeOut();

        if (response.status == 'success') {
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
                tile.style.backgroundColor = valueToColor(item.points);
                tile.style.lineHeight = `${rowHeight}px`;
                tile.style.textAlign = 'center';
                tile.innerText = item.team;
                tile.dataset.name = item.team;
                tile.dataset.value = item.points;

                container.appendChild(tile);

                currentX += itemWidth;
            });

            currentY += rowHeight;
            remainingData = remainingData.slice(rowData.length); // Remover dados processados
        }
    }

    drawRects(data, 0, 0, width, height);
}

function valueToColor(value) {
    const maxValue = 100; // Valor máximo de exemplo
    const ratio = value / maxValue;
    return `rgb(${Math.floor(255 * (1 - ratio))}, ${Math.floor(255 * ratio)}, 0)`;
}
