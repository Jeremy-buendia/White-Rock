@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Quiénes Somos</h1>
                <p>White-Rock Inmobiliaria es una empresa líder en el sector inmobiliario, comprometida con ofrecer servicios de alta calidad y experiencias excepcionales a nuestros clientes. Con años de experiencia en el mercado, nos especializamos en la compra, venta y alquiler de propiedades residenciales y comerciales.</p>
                <p>Nuestra misión es ayudarte a encontrar el hogar de tus sueños o la inversión perfecta, brindando asesoramiento personalizado y acompañamiento en cada paso del proceso. Nos enorgullece contar con un equipo de profesionales altamente capacitados y apasionados por el mundo inmobiliario, siempre listos para atender tus necesidades y superar tus expectativas.</p>
                
                <h2>Nuestros Valores</h2>
                <ul>
                    <li><strong>Transparencia:</strong> Creemos en la honestidad y la claridad en todas nuestras operaciones.</li>
                    <li><strong>Innovación:</strong> Utilizamos las últimas tecnologías y tendencias del mercado para ofrecerte el mejor servicio.</li>
                    <li><strong>Compromiso:</strong> Nos dedicamos a satisfacer las necesidades de nuestros clientes con dedicación y esfuerzo.</li>
                    <li><strong>Calidad:</strong> Nos esforzamos por mantener altos estándares de calidad en cada una de nuestras transacciones.</li>
                </ul>

                <h2>Por Qué Elegirnos</h2>
                <ul>
                    <li>Amplia cartera de propiedades en las mejores ubicaciones.</li>
                    <li>Asesoramiento experto y personalizado.</li>
                    <li>Procesos simples y eficientes.</li>
                    <li>Atención al cliente de primera clase.</li>
                </ul>

                <p>En White-Rock Inmobiliaria, tu satisfacción es nuestra prioridad. ¡Déjanos ayudarte a convertir tus sueños en realidad!</p>

                <h2>Dónde Encontrarnos</h2>
                <p>Nos encontramos en C. Poeta Rafael Alberti, 8, 11500 El Puerto de Sta María, Cádiz</p>
                <div style="width: 100%; height: 400px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.935837353048!2d-6.242444684692292!3d36.59277008026556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd217d0e0b0b1%3A0x0!2zMzbcgzMnMzUuOTk5IlMgNiAyNCcwLjA5NiJX!5e0!3m2!1ses!2ses!4v1616581234567!5m2!1ses!2ses" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
                <br>
                <br>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('favicon.ico') }}" alt="White Rock Logo" style="width: 200px; height: 200px;">
            </div>
        </div>
    </div>
@endsection