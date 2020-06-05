$('#noResultados').hide();
$(function(){    
    $('#raza').change(function(){
        if($('#raza').val()){
            let raza = $('#raza').val();
            console.log($('#raza').val());
            $.ajax({
                url : 'mascotas.php',
                type : 'POST',
                data : {raza},
                success : function(response){
                    let mascotas = JSON.parse(response);
                    let template = '';
                    var cont = 0;
                    
                    mascotas.forEach(mascota => {
                        template += `
                            <tr mascota-Id="${mascota.idMascota}">
                                <td><img src="images/${mascota.foto}" alt="${mascota.foto}"></td>
                                <td>${mascota.nombre}</td>
                                <td>${mascota.edad} meses</td>
                                <td>${mascota.descripcion}</td>
                                <td><button class="seleccionar">Seleccionar</button></td>
                            </tr>
                        `
                        cont = cont+1;
                    });
                    $('#mascotas').html(template);
                    if(cont==0){
                        let nada = `No se han encontrado resultados`;
                        $('#nada').html(nada);
                        $('#noResultados').show();
                    }else{
                        $('#noResultados').hide();
                    }

                    // console.log(template);
                }
            })
        }
    })
});


$(document).on('click', '.seleccionar', function(){
    $('.seleccionar').css("background","white");
    $('.seleccionar').css("color","#1E8794");
    let element = $(this)[0].parentElement.parentElement;
    let b = $(this);
    console.log(b);
    b.css("background", "#EF9F33", "color", "white");
    b.css("color", "white");
    let id = $(element).attr('mascota-Id');
    console.log(id);
    $('#idMascota').val(id);


})

$(function(){
    $('#cliente').change(function(){
        let cliente = $('#cliente').val();
        console.log(cliente);
        $.ajax({
            url : 'clientes.php',
            type : 'POST',
            data : {cliente},
            success : function(response){
                let mascotasCliente = JSON.parse(response);
                let template = '';
                let cont = 0;
                mascotasCliente.forEach(mascotaC => {
                    template += `
                        <tr>
                            <td><img src="images/${mascotaC.foto}" alt="${mascotaC.foto}"></td>
                            <td>${mascotaC.nombre}</td>
                            <td>${mascotaC.edad} meses</td>
                            <td>${mascotaC.descripcion}</td>
                        </tr>
                    `
                    cont = cont+1;
                });
                $('#mascotas').html(template);
                if(cont==0){
                    let nada = `No se han encontrado resultados`;
                    $('#nada').html(nada);
                    $('#noResultados').show();
                }else{
                    $('#noResultados').hide();
                }
            }
        })
    })
});
