@foreach ($users as $user)
  <p>
    {{ $user->name }}さん
  </p>
@endforeach