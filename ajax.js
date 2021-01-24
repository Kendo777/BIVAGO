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
	var url = "http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=CrapiKodaa&psw=12345&orderBy="+order;
	if(order == "price") DATA = orderByPrize(DATA);
	else if (order == "name") DATA = orderByName(DATA);
	gotData(DATA);
}


function changeProductsByFilter(filter)
{
	var url = "http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=CrapiKodaa&psw=12345&filter="+filter;
	//console.log(url);
	var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			DATA = JSON.parse(this.responseText);
			DATA = orderByName(DATA);
			//DATA = orderByPrize(DATA);
			//console.log(DATA);
			gotData(DATA);
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
	var string = " " + page + " ";
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
				if(product['shop']!=undefined)
				{
				    string += '<a href = "index.php?page=itemInfo&shop='+product['shop']+'&item='+product['id']+'"><h5 class="card-title">'+product['name']+'</h5></a>';
					string += '<td><a href = "index.php?page=itemInfo&shop='+product['shop']+'&item='+product['id']+'"><img src="'+product['img']+'" width="200" height="260"></a></td>';
				}
				else
				{
				    string += '<a href = "index.php?page=itemInfo&item='+product['id']+'"><h5 class="card-title">'+product['name']+'</h5></a>';
					string += '<td><a href = "index.php?page=itemInfo&item='+product['id']+'"><img src="'+product['img']+'" width="200" height="260"></a></td>';
				}
                    
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

function pagination(page)
{
	//console.log(page);
	gotData(DATA,page);
}
function updateTextInput(val) 
{
    document.getElementById('textInput').innerHTML=val+"$"; 
    //codigo de dentro del rango o en su defecto (actual) mayor de x
}