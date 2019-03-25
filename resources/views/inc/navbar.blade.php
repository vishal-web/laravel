<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{config('app.name')}} First App</a>
    </div>
    
    @if (isset($navigation))
    <div class="nav navbar-nav navbar-right">
      @foreach($navigation as $nav)
        
        <li class="active">
          <a class="" href="{{$nav['href']}}">{{$nav['title']}}</a>
        </li>
      @endforeach
    </div>
    @endif

    {{-- <div id="navbar" class="navbar-collapse collapse">
      <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
      </form>
    </div> --}}
    <!--/.navbar-collapse -->
  </div>
</nav>