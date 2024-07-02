listaProdutos = [];
produtosAtualizado = []
function inserirProdutos(productId, productName, description, prince, amount, category, tdFacturas, image) {
    productos = {
        productId: productId,
        productName: productName,
        description: description,
        prince: prince,
        amount: amount,
        category: category,
        image: image,
        estado: 0,
        qtdComprada: 0,
        tdFacturas: tdFacturas,
        orderInvoice: ""
    }
    listaProdutos.push(productos);
}
function fecharConta() {
    // Obtém a data atual
    let currentDate = new Date();
    let invoiceDate = currentDate.toISOString().split('T')[0]; // Formato YYYY-MM-DD

    // Loop pelos produtos na lista
    listaProdutos.forEach(function (item, index) {
        // Verifica se o estado do produto é 1
        if (item.estado === 1) {
            produtosAtualizado.push(listaProdutos[index]);
            // Monta o corpo da requisição com os dados do item atual
            let requestBody = {
                orderInvoice: 'INV' + (item.tdFacturas), // Usando tdFacturas para gerar o número de fatura
                productId: item.productId,
                amount: parseInt(item.qtdComprada),
                total: parseFloat(parseFloat(item.qtdComprada) * parseFloat(item.prince)),
                invoiceDate: invoiceDate
            };

            // Opções da requisição
            let requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestBody)
            };

            // URL local para onde enviar a requisição
            let url = '../Actions/InvoiceForms.php';

            // Faz a requisição usando fetch
            fetch(url, requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao enviar requisição.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        //console.log(`Requisição enviada com sucesso para o item ${index + 1}.`);
                        listaProdutos[index].orderInvoice = requestBody.orderInvoice;
                        // produtosAtualizados = JSON.parse(localStorage.getItem('produtosAtualizados')) || [];
                        localStorage.setItem('produtosAtualizado', JSON.stringify(produtosAtualizado));
                        location.href = "../Views/Fatura.php"

                        //console.log("Lista de Produtos atualizada:", listaProdutos);
                        //alert("Fatura criada com sucesso!");
                    } else {
                        //console.error('Erro ao inserir fatura no banco de dados:', data.message);
                       // location.href = "../Views/Fatura.php"
                        localStorage.setItem('produtosAtualizado', JSON.stringify(produtosAtualizado));
                    
                        alert("Erro ao inserir fatura no banco de dados: " + data.message);
                    }
                })
                .catch(error => {
                    localStorage.setItem('produtosAtualizado', JSON.stringify(produtosAtualizado));
                    
                     location.href = "../Views/Fatura.php"
                    console.error('Erro ao enviar requisição:', error);
                    //alert("Erro ao enviar requisição: " + error.message);
                });
        }
    });
}


// Função para criar a tabela com base na lista de produtos
function criarTabelaProdutos() {
    let tabela = document.createElement('table');
    tabela.className = 'table table-bordered';
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    // Cabeçalho da tabela
    let cabecalho = '<tr>' +
        '<th>#</th>' +
        '<th>Descrição</th>' +
        '<th>Quantidade</th>' +
        '<th>Preço Unitário</th>' +
        '<th>Total</th>' +
        '</tr>';
    thead.innerHTML = cabecalho;
    tabela.appendChild(thead);

    // Corpo da tabela com dados dinâmicos
    // Verifica se há dados no localStorage para produtos atualizados
    let produtosAtualizados = JSON.parse(localStorage.getItem('produtosAtualizado'));

    produtosAtualizados.forEach(function (produto, index) {
        let linha = document.createElement('tr');
        linha.innerHTML = '<td>' + (index + 1) + '</td>' +
            '<td>' + produto.productName + '</td>' +
            '<td>' + produto.qtdComprada + '</td>' +
            '<td>R$ ' + parseFloat(produto.prince).toFixed(2) + '</td>' +
            '<td>R$ ' + (produto.qtdComprada * parseFloat(produto.prince)).toFixed(2) + '</td>';
        tbody.appendChild(linha);
    });

    tabela.appendChild(tbody);

    // Adicionar a tabela ao elemento com id "tabelaProdutos" (substitua pelo seu id real)
    let tabelaContainer = document.getElementById('tabelaProdutos');
    tabelaContainer.innerHTML = ''; // Limpa o conteúdo atual, se houver
    tabelaContainer.appendChild(tabela);
}

// Chamar a função para criar a tabela assim que a página carregar
document.addEventListener('DOMContentLoaded', function () {
    criarTabelaProdutos();
});

