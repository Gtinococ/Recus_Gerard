<x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{url('update/'.$user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    NOMBRE:<input type="text" name="name" value="{{$user->name}}"></br>
    APELLIDO:<input type="text" name="lastname" value="{{$user->lastname}}"></br>
    E-MAIL:<input type="text" name="email" value="{{$user->email}}"></br>
    CONTRASEÑ:<input type="password" name="password"></br>
    REPITE CONTRASEÑ:<input type="password" name="pass_confirm"></br>
    FOTO:<input type="file" name="file"></br>
    <button type="submit">Enviar</button>
</form>