function autocomplementar() {
    const inputBusqueda = document.querySelector("#tipoBusqueda");
    let indexFocus = -1;
    inputBusqueda.addEventListener('input', function () {
        const tipoBusqueda = this.value;
        if (!tipoBusqueda)
            return false;
        //Crear sugerencias
        const divList = document.createElement('div');
        divList.setAttribute('id', this.id + '-lista-autocompletar');
        divList.setAttribute('class', 'lista-autocompletar-items');
        this.parentNode.appendChild(divList);
        //Consulta a base de datos
        const arreglo = httpRequest(tipoBusqueda);
        var arra = document.getElementById("parseRepuesta").value;
        if (arra == "") {
        } else {
            var arra = JSON.parse(arra);
            array = [];
            for (var i = 0; i < arra.length; i++) {
                array.push(arra[i].nombreEmpresa);
            }
            //Validar si es un arreglo vs input
            if (array.length == 0)
                return false;
            array.forEach(item => {
                if (item.substr(0, tipoBusqueda.length) == tipoBusqueda.toUpperCase()) {
                    const elementoLista = document.createElement('div');
                    console.log(elementoLista);
                    elementoLista.innerHTML = `<strong>${item.substr(0, tipoBusqueda.length)}</strong>${item.substr(tipoBusqueda.length)}`;
                    elementoLista.addEventListener('click', function () {
                        inputBusqueda.value = this.innerText;
                        console.log(this.innerText);
                        cerrarLista();
                        return false;
                    })
                    divList.appendChild(elementoLista);
                }
            });
        }
    })
    inputBusqueda.addEventListener('keydown', function (e) {
        const divList = document.querySelector('#' + this.id + '-lista-autocompletar');
        let items;
        if (divList) {
            items = divList.querySelectorAll('div');
            switch (e.keyCode) {
                case 40: //tecla de abajo
                    indexFocus++;
                    if (indexFocus > items.length - 1)
                        indexFocus = items.length - 1;
                    break;
                case 38: //tecla de arriba
                    indexFocus--;
                    if (indexFocus < 0)
                        indexFocus = 0;
                    break;
                case 13: // presionas enter
                    e.preventDefault();
                    items[indexFocus].click();
                    indexFocus = -1;
                    break;
                default:
                    break;
            }
            seleccionar(items, indexFocus);
            return false;
        }
    });
    document.addEventListener('click', function () {
        cerrarLista();
    });
}

function httpRequest(tipoBusqueda) {
    var arrayList = new Array();
    var datos = new FormData();
    datos.append("tipoBusquedaEmpresa", tipoBusqueda);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != "SC") {
                document.getElementById("parseRepuesta").value = "";
                document.getElementById("parseRepuesta").value = JSON.stringify(respuesta);
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
}
function seleccionar(lista, indexFocus) {
    if (!lista || indexFocus == -1)
        return false;
    lista.forEach(x => {
        x.classList.remove('autocompletar-active')
    });
    lista[indexFocus].classList.add("autocompletar-active");
}

function cerrarLista() {
    const items = document.querySelectorAll('.lista-autocompletar-items');
    items.forEach(item => {
        item.parentNode.removeChild(item);
    });
    indexFocus = -1;
}

autocomplementar();






$(document).on("change", "#tipoBusqueda", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    var cartaDeCupoVal = await patternCharsetNumProduc(cartaDeCupo);
    console.log(cartaDeCupoVal);
    if (cartaDeCupoVal == 0) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    } else if (cartaDeCupoVal == 1) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    }
})
$(document).on("change", "#bultosAgregados", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= 1) {
        var cartaDeCupoVal = await patternPregNumEntero(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            cerrarLista();
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    }
})
$(document).on("change", "#pesoAgregado", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        } else {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    }
})
$(document).on("change", "#ClPolDua", async function () {
    var cartaDeCupo = $(this).val();
    if (cartaDeCupo.length >= 16) {
        var e = document.getElementById("regimenPoliza");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;
        var cartaDeCupoVal = await patternPreg(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (indexText == "TO" || indexText == "DUT" || indexText == "FAUCA") {
            var cartaDeCupoVal = 1;
            document.getElementById("hiddenClPolDua").value = 1;
            $(this).val(0);
        }
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolDua").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolDua").value = 1;
        }
    } else if (cartaDeCupo.length <= 15) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolDua").value = 0;
    }
})

$(document).on("change", "#ClPolBL", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo);
    if (cartaDeCupo.length >= 7) {
        var e = document.getElementById("regimenPoliza");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;
        var cartaDeCupoVal = await patternPregSinG(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (indexText == "DUT" || indexText == "FAUCA") {
            var cartaDeCupoVal = 1;
            document.getElementById("hiddenClPolBL").value = 1;
            $(this).val(0);
        }
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolBL").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolBL").value = 1;
        }
    } else if (cartaDeCupo.length <= 6) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolBL").value = 0;
    }
})

$(document).on("change", "#ClPolPeso", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolPeso").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolPeso").value = 1;
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolPeso").value = 0;
    }
})
$(document).on("change", "#ClPolTAduana", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolTAduana").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolTAduana").value = 1;
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolTAduana").value = 0;
    }
})
$(document).on("change", "#ClPolCambio", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolCambio").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolCambio").value = 1;
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolCambio").value = 0;
    }
})
$(document).on("change", "#ClPolCif", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolCif").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolCif").value = 1;
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolCif").value = 0;
    }
})
$(document).on("change", "#ClPolImpuesto", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    if (cartaDeCupo >= .01) {
        var cartaDeCupoVal = await patternPregNum(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("hiddenClPolImpuesto").value = 0;
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            document.getElementById("hiddenClPolImpuesto").value = 1;
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolImpuesto").value = 0;
    }
})

$(document).on("change", "#ClPolProducto", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    var cartaDeCupoVal = await patternPregSpaceSG(cartaDeCupo);
    console.log(cartaDeCupoVal);
    if (cartaDeCupoVal == 0) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        document.getElementById("hiddenClPolProducto").value = 0;
    } else if (cartaDeCupoVal == 1) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        document.getElementById("hiddenClPolProducto").value = 1;
    }
})



