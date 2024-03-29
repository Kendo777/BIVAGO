var DATA = {
};

function changeProducts()
{
	var url = "http://localhost/PAPI/Group/API-grupo/metaSearch.php";
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA = JSON.parse(this.responseText);
			DATA = orderByName(DATA);
			gotData(DATA);
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();
}

function changeProductsBySearch()
{
	var search = document.getElementById('browser').value;
	var url = "http://localhost/PAPI/Group/API-grupo/metaSearch.php?search="+search;
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA = JSON.parse(this.responseText);
			DATA = orderByName(DATA);
			gotData(DATA);
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();


}

function changeProductsByOrder(order)
{
	if(order == "price") DATA = orderByPrize(DATA);
	else if (order == "name") DATA = orderByName(DATA);
	gotData(DATA);
}


function changeProductsByFilter(filter)
{
	var numProds = DATA.length;
	var json = [];
	for (var i=0; i < numProds; i++) 
    { 
		var product = DATA[i];
		if(product)
		{
			var strAux = product['category'];
			if(strAux.search(filter) != -1)
			{
				json.push(product);
			}
		}
    }
	gotData(json);
}

function changeProductsBySubCat(filter)
{
	var numProds = DATA.length;
	var json = [];
	for (var i=0; i < numProds; i++) 
    { 
		var product = DATA[i];
		if(product)
		{
			var strAux = product['subCategory'];
			if(strAux.search(filter) != -1)
			{
				json.push(product);
			}
		}
    }
	gotData(json);
}

function changeProductsByPrize(filter)
{
	updateTextInput(filter);
	var numProds = DATA.length;
	var json = [];
	for (var i=0; i < numProds; i++) 
    { 
		var product = DATA[i];
		if(product)
		{
			var strAux = product['prize'];
			if(strAux > filter)
			{
				json.push(product);
			}
		}
    }
	gotData(json);
}
function changeProductsByShippment(value)
{
	var check = document.getElementById("ShippmentCheckbox").checked;
	if(check)
	{
		var numProds = DATA.length;
		var json = [];
		for (var i=0; i < numProds; i++) 
	    { 
			var product = DATA[i];
			if(product)
			{
				var strAux = product['shippment'];
				if(strAux==0)
				{
					json.push(product);
				}
			}
	    }
		gotData(json);
	}
	else
	{
		gotData(DATA);
	}
}

function buyProduct()
{
	var shop = document.getElementById('shopId').value;
	var item = document.getElementById('productId').value;
	var cuantity = document.getElementById('cuantity').value;
	var user = document.getElementById("user").textContent;
	var url = "http://localhost/PAPI/Group/API-grupo/metaSearch.php?user="+user+"&shop="+shop+"&item="+item+"&cuantity="+cuantity;
	console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA = JSON.parse(this.responseText);
			updateData(DATA);
		}
	};
	xhttp.open('GET', url, true);
	xhttp.send();

}

function orderByName( d )
{
	d.sort( compareName );
	return d;
}

function orderByPrize( d )
{
	d.sort( comparePrice );
	return d;
}

function compareName( a, b )
{
  if ( a.name < b.name ) return -1;

  if ( a.name > b.name ) return 1;

  return 0;
}

function comparePrice( a, b )
{
  if ( a.prize < b.prize ) return -1;

  if ( a.prize > b.prize ) return 1;

  return 0;
}

function gotData(data,page=1) {
	var string = "";
	var items = data;
	var k=(page-1)*15;
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
				string += '<a href = "index.php?page=itemInfo&shop='+product['shop']+'&item='+product['id']+'"><h5 class="card-title">'+product['name']+'</h5></a>';
				string += '<td><a href = "index.php?page=itemInfo&shop='+product['shop']+'&item='+product['id']+'"><img src="'+product['img']+'" width="200" height="260"></a></td>';

                    
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

function updateData(data)
{
	console.log(data);
	document.getElementById('stock').innerHTML= "Stock: "+data['stock'];
	if(data['stock']>0)
	{
		document.getElementById('cuantity').setAttribute("max",data['stock']);;
	}
	else
	{
		document.getElementById('addToCart').innerHTML = '<button type="button" class="btn btn-secondary" disabled>Sold Out</button>';
	}
	
}

function pagination(page)
{
	//console.log(page);
	gotData(DATA,page);
}

function getDataLenght()
{
	return DATA.length;
}

function updateTextInput(val) 
{
    document.getElementById('textInput').innerHTML=val+"$"; 
}