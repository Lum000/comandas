const burguer = document.getElementById('burguer');
const porcao = document.getElementById('porcao');
const bebidas = document.getElementById('bebidas');
const diversos = document.getElementById('diversos');

// Adicione um ouvinte de evento de clique para cada botão
burguer.addEventListener('click', function() {
  fetchProducts('lanche'); // chama a função para obter produtos
  burguer.style.backgroundColor = "red";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
    bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});

porcao.addEventListener('click', function() {
  fetchProducts('porcao'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "red";
    bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});
bebidas.addEventListener('click', function() {
  fetchProducts('bebidas'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
  bebidas.style.backgroundColor = "red";
  diversos.style.backgroundColor = "rgb(2, 95, 244)";
});
diversos.addEventListener('click', function() {
  fetchProducts('diversos'); // chama a função para obter produtos
  burguer.style.backgroundColor = "rgb(2, 95, 244)";
  porcao.style.backgroundColor = "rgb(2, 95, 244)";
  bebidas.style.backgroundColor = "rgb(2, 95, 244)";
  diversos.style.backgroundColor = "red";
});

// Função para obter produtos com base no parâmetro de pesquisa
function fetchProducts(searchParam) {
  const productsDiv = document.querySelector('.products_add');
  productsDiv.innerHTML = ''; // Limpa os resultados anteriores

  // Faz uma solicitação ao banco de dados com base no parâmetro de pesquisa
  fetch(`get_products.php?search=${searchParam}`)
    .then(response => response.json())
    .then(data => {
      // Percorre os resultados e adiciona cada produto à div de produtos
      data.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = `
        <form action="add.php" method="POST">
          <span class="product_name"><h2 id='span'>${product.product}</h2></span>
          <span class="product_price"><h3>R$ ${product.price}</h3></span>
          <input type="hidden" name="id_product" value="${product.id}">
          <input type="hidden" name="table_id" value="<?php echo $table_id?>">
          <input type="submit" name="add" value="+">
        </form>
        `;
        productsDiv.appendChild(productDiv);
      });
    })
    .catch(error => console.error(error));
}
function cach_products(){
    console.log('OLA')
};

//dialog pop up

var showProductsButton = document.querySelector('#dialog');
var productsDialog = document.querySelector('#products-dialog');

const pagarBtn = document.getElementById('pagar-btn');
    
    // Adicione um ouvinte de evento para o clique do botão
    pagarBtn.addEventListener('click', function() {
        // Selecione todos os checkboxes com nome "paid"
        const checkboxes = document.querySelectorAll('input[name="paid"]:checked');
        // Crie um array para armazenar os valores dos IDs
        const ids = [];
        // Adicione cada valor de ID ao array
        checkboxes.forEach(function(checkbox) {
            ids.push(checkbox.value);
        });
        // Crie a URL com os IDs concatenados
        const url = `pagar_comanda.php?id=<?php echo $table_id?>&id_product=${ids.join(',')}`;
        // Redirecione para a nova URL
        window.location.href = url;
    });

function altername(){
    name = document.getElementById('table_name_alter').value;
    window.location.href = `new-tables.php?id=<?php echo $table_id?>&name=${name}`;
}


function openPopup() {
    const dialog = document.getElementById("products-dialog");
    dialog.showModal();
    }

function closePopup() {
    const dialog = document.getElementById("products-dialog");
        dialog.close();
    }

    document.getElementById("exit").addEventListener("click", closePopup);