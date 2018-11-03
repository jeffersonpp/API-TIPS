<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
<!--        <th colspan="2">Action</th>-->
        <th>Action</th>
        <th>
          <form action="{{action('TipController@create')}}" method="get">		
             @csrf
			<button class="btn btn-primary" type='submit'>New</button>
          </form>
		</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($tips as $tip)
      <tr>
        <td>{{$tip->id}}</td>
        <td>{{$tip->tiptitle}}</td>
        <td>{{$tip->tipdescription}}</td>
        <td><a href="{{action('TipController@edit', $tip->id)}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('TipController@destroy', $tip->id)}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>