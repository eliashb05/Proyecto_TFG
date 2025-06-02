<h2>Nuevo mensaje de contacto</h2>
<p><strong>Nombre:</strong> {{ $datos['nombre'] }}</p>
<p><strong>Email:</strong> {{ $datos['email'] }}</p>
<p><strong>Asunto:</strong> {{ $datos['asunto'] }}</p>
<p><strong>Mensaje:</strong></p>
<p>{!! nl2br(e($datos['mensaje'])) !!}</p>