<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ config('app.name') }}</title>
</head>
<body style="background-color: #f8fafc; color: #334155; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; width: 100% !important;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f8fafc; margin: 0; padding: 30px 15px; width: 100%;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); margin: 0 auto; max-width: 570px; overflow: hidden; width: 100%;">
                    
                    {{-- Header --}}
                    @include('mail::header')

                    {{-- Email Body --}}
                    <tr>
                        <td style="padding: 35px 40px;">
                            <h1 style="color: #0f172a; font-size: 24px; font-weight: bold; margin-top: 0; margin-bottom: 20px; font-family: Arial, sans-serif; text-align: left;">¡Hola!</h1>
                            
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-top: 0; margin-bottom: 25px; font-family: Arial, sans-serif; text-align: left;">
                                Recibiste este correo porque hiciste una solicitud para restablecer la contraseña de tu cuenta.
                            </p>
                            
                            
                            <div style="text-align: center; margin: 35px 0;">
                                <a href="{{ $actionUrl ?? '#' }}" style="background-color: #3b82f6; border-radius: 6px; color: #ffffff !important; display: inline-block; font-size: 16px; font-weight: bold; padding: 12px 30px; text-decoration: none; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3); font-family: Arial, sans-serif;">
                                    Restablecer Contraseña
                                </a>
                            </div>
                            
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-top: 0; margin-bottom: 15px; font-family: Arial, sans-serif; text-align: left;">
                                Este enlace para restablecer la contraseña expirará en 60 minutos.
                            </p>
                            
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-top: 0; margin-bottom: 25px; font-family: Arial, sans-serif; text-align: left;">
                                Si no realizaste esta solicitud, puedes ignorar este correo de forma segura.
                            </p>
                            
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-top: 0; margin-bottom: 0; font-family: Arial, sans-serif; text-align: left;">
                                Saludos,<br>
                                <strong style="color: #0f172a;">El equipo de Carga y Logística Tolima.</strong>
                            </p>
                        </td>
                    </tr>
                    
                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #0f172a; padding: 25px 40px; text-align: center;">
                            <p style="color: #ffffff; font-size: 14px; font-weight: bold; margin: 0 0 5px 0; font-family: Arial, sans-serif;">
                                Carga y Logística Tolima
                            </p>
                            <p style="color: #94a3b8; font-size: 12px; margin: 0; font-family: Arial, sans-serif;">
                                © {{ date('Y') }} Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>