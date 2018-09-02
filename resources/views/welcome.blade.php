<!DOCTYPE html>
<html>
    <head>
        <title>People</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="/styles.css">
    </head>
    <body>
        <div class="container">
            <h1 class="page__heading">People!</h1>
            
            @if ($errors->any())
                <div class="col-10 col-lg-6 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form class="col-12 col-lg-4 mx-auto add__user__form mb-5" method="post" action="/" enctype="multipart/form-data">
              {{ csrf_field() }} 
              
              <div class="error__message__js"></div>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control create__name" name="Name" id="name" aria-describedby="name" placeholder="Users Name">
              </div>
              
              <div class="form-group">
                <label for="exampleFormControlFile1">Users Image</label>
                <input type="file" class="form-control-file create__image" name="Picture" id="exampleFormControlFile1">
              </div>
              
              <button type="submit" class="btn btn-success">Add User</button>
            </form>
        </div>
        
        <div class="container">
            @foreach ($people as $person)
                <div class="user__block mb-2 col-12 col-lg-6 mx-auto">
                    <div class="user__block__inner">
                      <img class="user__image" src="/images/{{ $person->Picture }}" alt="Picture of {{ $person->Name }}">
                      <div class="user__content">
                          <h5 class="user__name">Users Name is {{ $person->Name }}</h5>
                          <a href="" class="btn btn-primary" data-toggle="modal" data-id="{{$person->id}}"data-target="#modal">Edit User</a>
                       </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if ($page_count > 1)
        <div class="container pt-5 pb-5">
            <nav aria-label="Page navigation example">
              <ul class="pagination mx-auto justify-content-center">
                @for ($i = 0; $i < $page_count; $i++)
                    
                        
                        {{-- Set active page --}}
                        @if($page == $i)
                            <li class="page-item active">
                                <div class="page-link ">{{ $i + 1 }}</div>
                              </li>  
                        @else 
                            <li class="page-item">
                                <a class="page-link" href="/?p={{$i}}">{{ $i + 1 }}</a>
                            </li>
                        @endif
                        
                        
                @endfor
              </ul>
            </nav>
        </div>
        @endif
        
        @include('partials.modal')
        

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    
    //modal logic
    
    $('.user__block a').on('click', function(){
        // reset the modal
        $('.modal-body').html("");
        
        var id = $(this).data('id');
        fetch(`/${id}`)
        .then(response => response.json())
        .then(data => {
            // display active person
            
            var img = document.createElement("IMG");
            img.src = `/images/${data.Picture}`;
            img.alt = `Picture of ${data.Name}`;
            
            var name = document.createElement("h3");
            name.textContent = `${data.Name}`;

            $('.modal-body').append(img);
            $('.modal-body').append(name);
            $('.edit__user__form').attr("action", `/${id}/edit`);
            $('.delete__user__form').attr("action", `/${id}/delete`);
        });
    })
    
    
    // Create Validation
    
    $('.add__user__form').on('submit', function(e){
        if ($('.create__name').val() === "") {
            e.preventDefault();
            displayError('Name field empty');
        }
        else if ($('.create__image').get(0).files.length === 0 || !$('.create__image').get(0).files[0].type.includes('image')) {
            e.preventDefault();
            displayError('Picture is required'); 
            
        }
    });
    
    function  displayError(message){
        $('.error__message__js').text(message);
        $('.error__message__js').fadeIn().delay(1000).fadeOut();
    }
    
</script>
    </body>
</html>
