listaProdutos=[];

function inserirProdutos(productId,productName,description,prince,amount,category,image){
    productos={
        productId:productId,
        productName:productName,
        description:description,
        prince:prince,
        amount:amount,
        category:category,
        image:image,
        estado:0
    }
    listaProdutos.push(productos);
}