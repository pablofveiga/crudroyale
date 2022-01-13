
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}



// NEW
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
})));


// TEST EDIT IN SAME PAGE
function editCard() {
  console.log("editando ia ia o");
}




function showHideCards(e){

    if (e.target.classList.contains("ctaComun")) {
        let _comunMaze = document.querySelectorAll("table tr.Común");
        for (let i = 0; i<_comunMaze.length; i++) {
            _comunMaze[i].classList.toggle("hidden");
        }
    }
    if (e.target.classList.contains("ctaEspe")) {
        let _espeMaze = document.querySelectorAll("table tr.Especial");
        for (let i = 0; i<_espeMaze.length; i++) {
            _espeMaze[i].classList.toggle("hidden");
        }
    }
    if (e.target.classList.contains("ctaEpic")) {
        let _epicMaze = document.querySelectorAll("table tr.Épica");
        for (let i = 0; i<_epicMaze.length; i++) {
            _epicMaze[i].classList.toggle("hidden");
        }
    }
    if (e.target.classList.contains("ctaLegend")) {
        let _legendMaze = document.querySelectorAll("table tr.Legendaria");
        for (let i = 0; i<_legendMaze.length; i++) {
            _legendMaze[i].classList.toggle("hidden");
        }
    }
    if (e.target.classList.contains("ctaAll")) {
        let _theMaze = document.querySelectorAll("table tr");
        for (let i = 0; i<_theMaze.length; i++) {
            _theMaze[i].classList.toggle("hidden");
        }
    }

}
document.addEventListener("click",showHideCards);



// CALCULATIONS
// var _columnas = document.querySelectorAll("tbody tr > td:nth-child(7)");

// _columnas.forEach(function(){
//   let suma = 0;
//   let _value = this.innerHTML;

//   console.log(this.innerHTML);
// //   suma = suma + _value;
// //   return _value;
// // console.log(_value);
// })




$("#calc13").click(function(){
  var total = 0;
  $("#crudroyale tbody tr > td:nth-child(8)").each(function(){
    if ( $(this).is(":visible")  ) {
      var _valor = $(this).html();
      _valor = parseInt(_valor);
      // total += $(this).html();
      total += _valor;
      return total;
    }
  })
  $("#total13suma").text(total);
  // console.log(  total)
})


$("#calcs").click(function(){
  var totalUnits = 0;
  $("#crudroyale tbody tr > td:nth-child(5)").each(function(){
    if ( $(this).is(":visible")  ) {
      var _valor = $(this).html();
      _valor = parseInt(_valor);
      totalUnits += _valor;
      return totalUnits;
    }
  })
  $("#totalUnits").text(number_format(totalUnits));  

  var totalLefts = 0;
  $("#crudroyale tbody tr > td:nth-child(7)").each(function(){
    if ( $(this).is(":visible")  ) {
      var _valor = $(this).html();
      _valor = parseInt(_valor);
      totalLefts += _valor;
      return totalLefts;
    }
  })
  $("#totalLefts").text(number_format(totalLefts));  

  // TOTAL BUY
  var valorBuy = 0;
  var valorMultiplier = 0;
  $("table#crudroyale tr.colorClass").each(function(){
    if ( $(this).is(":visible")  ) { 

        _calidad = $(this).attr("class");
       
        if (_calidad.includes("Común")) {
            valorMultiplier = 10;        
        } else if (_calidad.includes("Especial")) {
            valorMultiplier = 100;
        } else if (_calidad.includes("Épica")) {
            valorMultiplier = 1000;
        } else if (_calidad.includes("Legendaria")) {
            valorMultiplier = 40000;
        }
        return valorMultiplier;

    }




  })
  valorBuy = totalLefts * valorMultiplier;
  $("#totalPurchase").text(number_format(valorBuy));  


  var totalGold = 0;
  $("#crudroyale tbody tr > td:nth-child(8)").each(function(){
    if ( $(this).is(":visible")  ) {
      var _valor = $(this).html();
      _valor = parseInt(_valor);
      totalGold += _valor;
      return totalGold;
    }
  })
  $("#totalGold").text(number_format(totalGold));  

  var totalPercent = totalUnits + totalLefts;
  var actualPercent = 100*totalUnits/totalPercent
  $("#actualPercent").text(number_format(actualPercent,2));  

})

$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});


$("#soloComun").click(function(e){
    e.preventDefault();
    $(".Épica").hide();
    $(".Especial").hide();
    $(".Legendaria ").hide();
    $(".Común").show();
})
$("#soloEspecial").click(function(){
    $(".Común").hide();
    $(".Épica").hide();    
    $(".Legendaria ").hide();
    $(".Especial").show();
})
$("#soloEpica").click(function(){
    $(".Común").hide();
    $(".Especial").hide();
    $(".Legendaria ").hide();
    $(".Épica ").show();
})
$("#soloLegendaria").click(function(){
    $(".Común").hide();
    $(".Épica").hide();
    $(".Especial").hide();
    $(".Legendaria ").show();
})