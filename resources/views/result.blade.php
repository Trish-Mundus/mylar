@extends('template')
@section('title')
Другая страница
@endsection
@section('content')
 <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
        <span class="fs-4">Review page</span>
      </a>

      <!--nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="/test">Test</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="/user/45/john">User</a>
      </nav-->
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
     
	  
	  @if(isset($k))
	  @if($errors->any())
	  <div class="alert alert-danger">
	  <ul>
	  @foreach($errors->all() as $e)
	  <li>{{$e}}</li>
	  @endforeach
	  </ul>
	  </div>
	  @endif
	  @foreach($data as $d)
	  <div class="alert alert-warning">
	  <h3>{{$d->theme}}</h3>
	  <p>{{$d->text}}</p>
	  <p>{{$d->email}}</p>
	  </div>
	  @endforeach
	  @endif
     
      @foreach($result as $round)
	  <table class="container text-center">
	  <thead>
	  <tr>
	  <td colspan="2"><div class="list-group-item-success display-6">Раунд №{{$round['round']}}</div></td>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
	  <td><div class="list-group-item-warning">Название стадиона</div></td>
	  <td><div class="list-group-item-warning">Размер стадиона</div></td>
	  </tr>
	  <tr>
	  <td><div class="bg-light fw-bold">{{$round['state_name']}}</div></td>
	  <td><div class="bg-light fw-bold">{{$round['state_size']}}</div></td>
	  </tr>
	  <tr>
	  <td colspan="2"><div class="list-group-item-danger">Судья</div></td>
	  </tr>
	  <tr>
	  <td><div class="bg-light fw-bold">{{$round['referee_name']}}</div></td>
	  <td><div class="bg-light fw-bold">{{$round['referee_sa']}}</div></td>
	  </tr>
	   <tr>
	  <td colspan="2"><div class="list-group-item-success">Команды</div></td>
	  </tr>
	  <tr>
	  @foreach($round['teams'] as $team)
	  <td style="vertical-align:top;"><div class="bg-dark text-white fw-bold">{{$team['team_name']}}</div>
	  <div class="bg-secondary text-white fw-bold">Игроки</div>
	  @php
      $i = 1;
      $b = 1;
      @endphp
	  @foreach($team['players'] as $player)
	  <div class="bg-light fw-bold text-left">{{$i++}}. {{$player->firstname}} {{$player->lastname}} {{$player->age}} years ({{$player->sex}})</div>
	 
	 @endforeach
	  <div class="bg-info text-white fw-bold">Болельщики</div>
	  @foreach($team['fans'] as $fans)
	  <div class="bg-light">{{$b++}}. {{$fans->firstname}} {{$fans->lastname}} {{$fans->age}} years ({{$fans->sex}})</div>
	  @endforeach
	  </td>
	  @endforeach
	  </tr>
	  
	  @foreach($round['who'] as $who)
	  <tr>
	  <td>{{$who['who']}} <span class="fw-bold">{{$who['name']}}</span> &mdash; {{$who['action']}}</td>
	  <td><span class="fw-bold text-danger">{{$who['result']}}</span></td>
	  </tr>
	  @endforeach
	  <tr>
	  <td colspan="2" class="bg-danger text-white">Счет <span class="fw-bold">{{$round['score']}}</span> &mdash; <span class="fw-bold">{{$round['time']}}</span></td>
	  </tr>
	  </tbody>
	  </table>
	  
      @endforeach
	  
    </div>
  </header>

    </div>
  </main>
  @endsection