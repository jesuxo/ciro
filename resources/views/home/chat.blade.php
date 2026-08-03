@extends('home.layouts.master')
@section('title')
    https://tiendaciro.com
@endsection
@section('css')
    <style>
        .chat-container {
            max-width: 800px;
            margin: 2rem auto;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .chat-messages {
            height: 400px;
            overflow-y: auto;
            padding: 1.5rem;
            background: #f8fafc;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            max-width: 80%;
            word-wrap: break-word;
        }

        .user-message {
            background: #667eea;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 0.25rem;
        }

        .bot-message {
            background: white;
            color: #1a202c;
            margin-right: auto;
            border-bottom-left-radius: 0.25rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .typing-indicator {
            background: #e2e8f0;
            color: #4a5568;
            font-style: italic;
            padding: 0.75rem 1rem;
        }

        .chat-input {
            display: flex;
            padding: 1rem;
            background: white;
            border-top: 1px solid #e2e8f0;
        }

        .chat-input input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .chat-input button {
            padding: 0.75rem 1.5rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .chat-input button:hover {
            background: #5a67d8;
        }

        .chat-input button:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
        }

        .error-message {
            background: #fed7d7;
            color: #c53030;
            border: 1px solid #fc8181;
        }
    </style>
@endsection
@section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="chat-container">
            <div class="chat-header">
                <h1 class="text-2xl font-bold">🤖 Asistente Virtual</h1>
                <p class="text-sm opacity-90">Tiendas Ciro - ¿En qué podemos ayudarte?</p>
            </div>

            <div id="chatMessages" class="chat-messages">
                <div class="message bot-message">
                    ¡Hola! Soy tu asistente virtual de Tiendas Ciro.
                    ¿En qué puedo ayudarte hoy? Puedo informarte sobre:
                    <br>• Productos y disponibilidad
                    <br>• Precios y promociones
                    <br>• Horarios de atención
                    <br>• Sucursales
                </div>
            </div>

            <div class="chat-input">
                <input type="text"
                       id="messageInput"
                       placeholder="Escribe tu mensaje..."
                       onkeypress="if(event.key === 'Enter') sendMessage()">
                <button id="sendButton" onclick="sendMessage()">
                    Enviar
                </button>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>

    </script>
@endsection
