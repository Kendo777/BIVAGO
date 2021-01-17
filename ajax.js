var DATA = {
	productsShop1 : [],
	productsShop2 : []
}
function changeProducts()
{
	console.log("hola");
	var url = "https://apimlozanoo20.000webhostapp.com/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345";
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.state == 200)
		{
			populateItems(this.responseText);
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();
}

function changeProductsBySearch()
{
	var search = document.getElementById('browser').value;
	var url = "https://apimlozanoo20.000webhostapp.com/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&search="+search;
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA.productsShop1 = this.responseText;
			gotData(DATA.productsShop1);
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();


}
function changeProductsByOrder(order)
{
	var url = "https://apimlozanoo20.000webhostapp.com/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&orderBy="+order;
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
		{
			DATA.productsShop1 = this.responseText;
			var url2 = "https://apijruiz20.000webhostapp.com/IA-II/getProducts.php?orderBy="+order;
			//console.log(url);
			var xhttp2;
			xhttp2=new XMLHttpRequest();
			xhttp2.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				DATA.productsShop2 = this.responseText;
				orderByPrize();
			}
		};
		xhttp2.open('GET', url2, true);
		xhttp2.send();
	}
	};
	xhttp.open('GET', url, true);
	xhttp.send();

}
function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

function changeProductsByFilter(filter)
{
	var url = "https://apimlozanoo20.000webhostapp.com/OnlineShop/getproductsShop1.php?user=CrapiKodaa&psw=12345&filter="+filter;
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA.productsShop1 = this.responseText;
			var url2 = "https://apimlozanoo20.000webhostapp.com/OnlineShop/getproductsShop1.php?user=CrapiKodaa&psw=12345&filter="+filter;
			//console.log(url);
			var xhttp2;
			xhttp2=new XMLHttpRequest();
			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					DATA.productsShop1.concat(this.responseText);
					gotData(DATA.productsShop1);
				}
			};
			xhttp2.open('GET', url2, true);
			xhttp2.send();
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();
}

function orderByPrize()
{
	 var products1 = JSON.parse(DATA.productsShop1);
	var products2 = JSON.parse(DATA.productsShop2);
	var items = products1.concat(products2);
	items = shuffle(items);
	 gotData();
}
function gotData(data) {
	var string = "";
	var items = JSON.parse(data);
	var k=0;
	for (var i=0; i <3; i++) 
    { 
        string +='<div class="row justify-content-md-center">';
        for (var j=0; j <5; j++) 
        { 
            var product = items[k];
            if(product)
            {
                string += '<div class="col-md-auto">'
                 string += '<div class="card text-center" style="width: 18rem;">';
                
                string += '<div class="card-body">';
				string += '<td><a href = "index.php?page=itemInfo&item='+product['id']+'"><img src="'+product['img']+'" width="200" height="260"></a></td>';
                string += '<a href = "index.php?page=itemInfo&item='+product['id']+'"><h5 class="card-title">'+product['name']+'</h5></a>';
                    
                string += '<p class="card-text text-truncate">'+product['description']+'</p>';
                string += '<p class="card-text">'+product['prize']+'$</p>';
                string += '<p class="card-text min">'+product['shippment']+'$ shipping</p>';
                string += '</div></div></div>';
            
            }
            k++;
        }
    }
  document.getElementById('items').innerHTML = string;
}
