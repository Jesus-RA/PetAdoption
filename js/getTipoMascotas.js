$(function(){
    $('#tipo').change(function(){
        if($('#tipo').val()){
            let tipo = $('#tipo').val();
            $.ajax({
                url : 'razas.php',
                type : 'POST',
                data : {tipo},
                success : function(response){
                    let razas = JSON.parse(response);
                    // console.log(mascotas);
                    let template = '<option>Seleccionar...</option>';
                    razas.forEach(raza => {
                        template += `<option value="${raza.idRazaMascota}">${raza.raza}</option>`
                    });
                    $('#raza').html(template);
                }
            })
        }
    })
});


$(function(){
    $('#tipoVerMascotas').change(function(){
        let tipo = $('#tipoVerMascotas').val();
        let pag = $('.item').attr('pag');   
        $.ajax({
            url: 'mascotasPaginacion.php',
            type: 'POST',
            data: {tipo, pag},
            success : function(response){
                let mascotas = JSON.parse(response);
                let template = '';
                var cont = 0;
                
                mascotas.forEach(mascota => {
                    template += `
                        <tr>
                            <td><img src="images/${mascota.foto}" alt="${mascota.foto}"></td>
                            <td>${mascota.nombre}</td>
                            <td>${mascota.edad} meses</td>
                            <td>${mascota.descripcion}</td>
                            <td>${mascota.dueno}</td>
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
        });
        
        $(document).on('click', '.item', function(){
            $('.liItem').attr("class","liItem");
            let element = $(this)[0];
            let pag = $(element).attr('pag');
            let b = $(this);
            let li = b.children();
            li.attr("class","liItem activo");
            $.ajax({
                url: 'mascotasPaginacion.php',
                type: 'POST',
                data: {tipo, pag},
                success : function(response){
                    let mascotas = JSON.parse(response);
                    console.log(response);
                    let template = '';
                    var cont = 0;
                    
                    mascotas.forEach(mascota => {
                        template += `
                            <tr>
                                <td><img src="images/${mascota.foto}" alt="${mascota.foto}"></td>
                                <td>${mascota.nombre}</td>
                                <td>${mascota.edad} meses</td>
                                <td>${mascota.descripcion}</td>
                                <td>${mascota.dueno}</td>
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
            });
        })
        
    })
});

// Obtener paginacion
$(function(){
    $('#tipoVerMascotas').change(function(){
        let tipo = $('#tipoVerMascotas').val();
        $.ajax({
            url: 'paginacion.php',
            type: 'POST',
            data: {tipo},
            success : function(response){
                let paginas = JSON.parse(response);
                let template = '';
                paginas.forEach(pagina =>{
                    p = pagina.numeroPagina;
                })
                for (i=0; i<p; i++){
                    template += `
                        <a class="item" pag="${i+1}">
                            <li class="liItem "> ${i+1} </li>
                        </a>
                    `
                }
                $('#pags').html(template);
            }
        });
            
    })
});

