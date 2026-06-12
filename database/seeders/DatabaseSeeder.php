<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\EstadoGuia;
use App\Models\TipoEntrega;
use App\Models\Rol;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use App\Models\Usuario;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $super1 = new User();

        /* $super1->id = 1; */
        $super1->name = "Carlos Ramirez";
        $super1->email = "sistemascarlosramirez@gmail.com";
        $super1->password = '$2y$12$PLAnpM8IybS32ZHBHZVl9.Oo78jPxjkf09NX.Evjm718d8a.oKElK';
        $super1->created_at = "2026-02-02 01:13:24";
        $super1->updated_at = "2026-02-02 01:13:24";

        $super1->save();

        $super2 = new User();

        /* $super2->id = 2; */
        $super2->name = "Juana Valentina";
        $super2->email = "juanitadiaz2828@gmail.com";
        $super2->password = '$2y$12$ccUCCGJTcI4gKof1FENdE.PhmPkpSWuS5E1FhDBWXD3QNSeJkYbCe';
        $super2->created_at = "2026-02-02 01:13:24";
        $super2->updated_at = "2026-02-02 01:13:24";

        $super2->save();







        //*******************CREACION DE CIUDADES ****************** */

        $ciudades = [
            // --- ANTIOQUIA ---
            ["nombre" => "MEDELLÍN - Antioquia", "codigo" => "05001"], // [cite: 1]
            ["nombre" => "ABEJORRAL - Antioquia", "codigo" => "05002"], // [cite: 1]
            ["nombre" => "ABRIAQUÍ - Antioquia", "codigo" => "05004"], // [cite: 1]
            ["nombre" => "ALEJANDRÍA - Antioquia", "codigo" => "05021"], // [cite: 1]
            ["nombre" => "AMAGÁ - Antioquia", "codigo" => "05030"], // [cite: 1]
            ["nombre" => "AMALFI - Antioquia", "codigo" => "05031"], // [cite: 1]
            ["nombre" => "ANDES - Antioquia", "codigo" => "05034"], // [cite: 1]
            ["nombre" => "ANGELÓPOLIS - Antioquia", "codigo" => "05036"], // [cite: 1]
            ["nombre" => "ANGOSTURA - Antioquia", "codigo" => "05038"], // [cite: 1]
            ["nombre" => "ANORÍ - Antioquia", "codigo" => "05040"], // [cite: 1]
            ["nombre" => "SANTAFÉ DE ANTIOQUIA - Antioquia", "codigo" => "05042"], // [cite: 1]
            ["nombre" => "ANZA - Antioquia", "codigo" => "05044"], // [cite: 1]
            ["nombre" => "APARTADÓ - Antioquia", "codigo" => "05045"], // [cite: 1]
            ["nombre" => "ARBOLETES - Antioquia", "codigo" => "05051"], // [cite: 1]
            ["nombre" => "ARGELIA - Antioquia", "codigo" => "05055"], // [cite: 1]
            ["nombre" => "ARMENIA - Antioquia", "codigo" => "05059"], // [cite: 1]
            ["nombre" => "BARBOSA - Antioquia", "codigo" => "05079"], // [cite: 1]
            ["nombre" => "BELMIRA - Antioquia", "codigo" => "05086"], // [cite: 1]
            ["nombre" => "BELLO - Antioquia", "codigo" => "05088"], // [cite: 1]
            ["nombre" => "BETANIA - Antioquia", "codigo" => "05091"], // [cite: 1]
            ["nombre" => "BETULIA - Antioquia", "codigo" => "05093"], // [cite: 1]
            ["nombre" => "CIUDAD BOLÍVAR - Antioquia", "codigo" => "05101"], // [cite: 1]
            ["nombre" => "BRICEÑO - Antioquia", "codigo" => "05107"], // [cite: 1]
            ["nombre" => "BURITICÁ - Antioquia", "codigo" => "05113"], // [cite: 1]
            ["nombre" => "CÁCERES - Antioquia", "codigo" => "05120"], // [cite: 1]
            ["nombre" => "CAICEDO - Antioquia", "codigo" => "05125"], // [cite: 1]
            ["nombre" => "CALDAS - Antioquia", "codigo" => "05129"], // [cite: 1]
            ["nombre" => "CAMPAMENTO - Antioquia", "codigo" => "05134"], // [cite: 1]
            ["nombre" => "CAÑASGORDAS - Antioquia", "codigo" => "05138"], // [cite: 1]
            ["nombre" => "CARACOLÍ - Antioquia", "codigo" => "05142"], // [cite: 1]
            ["nombre" => "CARAMANTA - Antioquia", "codigo" => "05145"], // [cite: 1]
            ["nombre" => "CAREPA - Antioquia", "codigo" => "05147"], // [cite: 1]
            ["nombre" => "EL CARMEN DE VIBORAL - Antioquia", "codigo" => "05148"], // [cite: 1]
            ["nombre" => "CAROLINA - Antioquia", "codigo" => "05150"], // [cite: 1]
            ["nombre" => "CAUCASIA - Antioquia", "codigo" => "05154"], // [cite: 1]
            ["nombre" => "CHIGORODÓ - Antioquia", "codigo" => "05172"], // [cite: 1]
            ["nombre" => "CISNEROS - Antioquia", "codigo" => "05190"], // [cite: 5]
            ["nombre" => "COCORNÁ - Antioquia", "codigo" => "05197"], // [cite: 5]
            ["nombre" => "CONCEPCIÓN - Antioquia", "codigo" => "05206"], // [cite: 5]
            ["nombre" => "CONCORDIA - Antioquia", "codigo" => "05209"], // [cite: 5]
            ["nombre" => "COPACABΑΝΑ - Antioquia", "codigo" => "05212"], // [cite: 5]
            ["nombre" => "DABEIBA - Antioquia", "codigo" => "05234"], // [cite: 5]
            ["nombre" => "DON MATÍAS - Antioquia", "codigo" => "05237"], // [cite: 5]
            ["nombre" => "EBÉJICO - Antioquia", "codigo" => "05240"], // [cite: 5]
            ["nombre" => "EL BAGRE - Antioquia", "codigo" => "05250"], // [cite: 5]
            ["nombre" => "ENTRERRIOS - Antioquia", "codigo" => "05264"], // [cite: 5]
            ["nombre" => "ENVIGADO - Antioquia", "codigo" => "05266"], // [cite: 5]
            ["nombre" => "FREDONIA - Antioquia", "codigo" => "05282"], // [cite: 5]
            ["nombre" => "FRONTINO - Antioquia", "codigo" => "05284"], // [cite: 5]
            ["nombre" => "GIRALDO - Antioquia", "codigo" => "05306"], // [cite: 5]
            ["nombre" => "GIRARDOTA - Antioquia", "codigo" => "05308"], // [cite: 5]
            ["nombre" => "GÓMEZ PLATA - Antioquia", "codigo" => "05310"], // [cite: 5]
            ["nombre" => "GRANADA - Antioquia", "codigo" => "05313"], // [cite: 5]
            ["nombre" => "GUADALUPE - Antioquia", "codigo" => "05315"], // [cite: 5]
            ["nombre" => "GUARNE - Antioquia", "codigo" => "05318"], // [cite: 5]
            ["nombre" => "GUATAPE - Antioquia", "codigo" => "05321"], // [cite: 5]
            ["nombre" => "HELICONIA - Antioquia", "codigo" => "05347"], // [cite: 5]
            ["nombre" => "HISPANIA - Antioquia", "codigo" => "05353"], // [cite: 5]
            ["nombre" => "ITAGUI - Antioquia", "codigo" => "05360"], // [cite: 5]
            ["nombre" => "ITUANGO - Antioquia", "codigo" => "05361"], // [cite: 5]
            ["nombre" => "JERICÓ - Antioquia", "codigo" => "05364"], // [cite: 5]
            ["nombre" => "LA CEJA - Antioquia", "codigo" => "05376"], // [cite: 5]
            ["nombre" => "LA ESTRELLA - Antioquia", "codigo" => "05380"], // [cite: 5]
            ["nombre" => "LA PINTADA - Antioquia", "codigo" => "05390"], // [cite: 5]
            ["nombre" => "LA UNIÓN - Antioquia", "codigo" => "05400"], // [cite: 5]
            ["nombre" => "LIBORINA - Antioquia", "codigo" => "05411"], // [cite: 5]
            ["nombre" => "MACEO - Antioquia", "codigo" => "05425"], // [cite: 5]
            ["nombre" => "MARINILLA - Antioquia", "codigo" => "05440"], // [cite: 5]
            ["nombre" => "MONTEBELLO - Antioquia", "codigo" => "05467"], // [cite: 5]
            ["nombre" => "MURINDÓ - Antioquia", "codigo" => "05475"], // [cite: 5]
            ["nombre" => "MUTATÁ - Antioquia", "codigo" => "05480"], // [cite: 5]
            ["nombre" => "NARIÑO - Antioquia", "codigo" => "05483"], // [cite: 5]
            ["nombre" => "NECOCLÍ - Antioquia", "codigo" => "05490"], // [cite: 5]
            ["nombre" => "NECHÍ - Antioquia", "codigo" => "05495"], // [cite: 5]
            ["nombre" => "OLAYA - Antioquia", "codigo" => "05501"], // [cite: 5]
            ["nombre" => "PEÑOL - Antioquia", "codigo" => "05541"], // [cite: 9]
            ["nombre" => "PEQUE - Antioquia", "codigo" => "05543"], // [cite: 9]
            ["nombre" => "PUEBLORRICO - Antioquia", "codigo" => "05576"], // [cite: 9]
            ["nombre" => "PUERTO BERRÍO - Antioquia", "codigo" => "05579"], // [cite: 9]
            ["nombre" => "PUERTO NARE - Antioquia", "codigo" => "05585"], // [cite: 9]
            ["nombre" => "PUERTO TRIUNFO - Antioquia", "codigo" => "05591"], // [cite: 9]
            ["nombre" => "REMEDIOS - Antioquia", "codigo" => "05604"], // [cite: 9]
            ["nombre" => "RETIRO - Antioquia", "codigo" => "05607"], // [cite: 9]
            ["nombre" => "RIONEGRO - Antioquia", "codigo" => "05615"], // [cite: 9]
            ["nombre" => "SABANALARGA - Antioquia", "codigo" => "05628"], // [cite: 9]
            ["nombre" => "SABANETA - Antioquia", "codigo" => "05631"], // [cite: 9]
            ["nombre" => "SALGAR - Antioquia", "codigo" => "05642"], // [cite: 9]
            ["nombre" => "SAN ANDRÉS DE CUERQUÍA - Antioquia", "codigo" => "05647"], // [cite: 9]
            ["nombre" => "SAN CARLOS - Antioquia", "codigo" => "05649"], // [cite: 9]
            ["nombre" => "SAN FRANCISCO - Antioquia", "codigo" => "05652"], // [cite: 9]
            ["nombre" => "SAN JERÓNIMO - Antioquia", "codigo" => "05656"], // [cite: 9]
            ["nombre" => "SAN JOSÉ DE LA MONTAÑA - Antioquia", "codigo" => "05658"], // [cite: 9]
            ["nombre" => "SAN JUAN DE URABÁ - Antioquia", "codigo" => "05659"], // [cite: 9]
            ["nombre" => "SAN LUIS - Antioquia", "codigo" => "05660"], // [cite: 9]
            ["nombre" => "SAN PEDRO - Antioquia", "codigo" => "05664"], // [cite: 9]
            ["nombre" => "SAN PEDRO DE URABA - Antioquia", "codigo" => "05665"], // [cite: 9]
            ["nombre" => "SAN RAFAEL - Antioquia", "codigo" => "05667"], // [cite: 9]
            ["nombre" => "SAN ROQUE - Antioquia", "codigo" => "05670"], // [cite: 9]
            ["nombre" => "SAN VICENTE - Antioquia", "codigo" => "05674"], // [cite: 9]
            ["nombre" => "SANTA BÁRBARA - Antioquia", "codigo" => "05679"], // [cite: 9]
            ["nombre" => "SANTA ROSA DE OSOS - Antioquia", "codigo" => "05686"], // [cite: 9]
            ["nombre" => "SANTO DOMINGO - Antioquia", "codigo" => "05690"], // [cite: 9]
            ["nombre" => "EL SANTUARIO - Antioquia", "codigo" => "05697"], // [cite: 9]
            ["nombre" => "SEGOVIA - Antioquia", "codigo" => "05736"], // [cite: 9]
            ["nombre" => "SONSON - Antioquia", "codigo" => "05756"], // [cite: 9]
            ["nombre" => "SOPETRÁN - Antioquia", "codigo" => "05761"], // [cite: 9]
            ["nombre" => "TÁMESIS - Antioquia", "codigo" => "05789"], // [cite: 9]
            ["nombre" => "TARAZÁ - Antioquia", "codigo" => "05790"], // [cite: 9]
            ["nombre" => "TARSO - Antioquia", "codigo" => "05792"], // [cite: 9]
            ["nombre" => "TITIRIBÍ - Antioquia", "codigo" => "05809"], // [cite: 9]
            ["nombre" => "TOLEDO - Antioquia", "codigo" => "05819"], // [cite: 9]
            ["nombre" => "TURBO - Antioquia", "codigo" => "05837"], // [cite: 9]
            ["nombre" => "URAMITA - Antioquia", "codigo" => "05842"], // [cite: 9]
            ["nombre" => "URRAO - Antioquia", "codigo" => "05847"], // [cite: 9]
            ["nombre" => "VALDIVIA - Antioquia", "codigo" => "05854"], // [cite: 9]
            ["nombre" => "VALPARAÍSO - Antioquia", "codigo" => "05856"], // [cite: 13]
            ["nombre" => "VEGACHÍ - Antioquia", "codigo" => "05858"], // [cite: 13]
            ["nombre" => "VENECIA - Antioquia", "codigo" => "05861"], // [cite: 13]
            ["nombre" => "VIGÍA DEL FUERTE - Antioquia", "codigo" => "05873"], // [cite: 13]
            ["nombre" => "YALÍ - Antioquia", "codigo" => "05885"], // [cite: 13]
            ["nombre" => "YARUMAL - Antioquia", "codigo" => "05887"], // [cite: 13]
            ["nombre" => "YOLOMBÓ - Antioquia", "codigo" => "05890"], // [cite: 13]
            ["nombre" => "YONDÓ - Antioquia", "codigo" => "05893"], // [cite: 13]
            ["nombre" => "ZARAGOZA - Antioquia", "codigo" => "05895"], // [cite: 13]

            // --- ATLÁNTICO ---
            ["nombre" => "BARRANQUILLA - Atlántico", "codigo" => "08001"], // [cite: 13]
            ["nombre" => "BARANOA - Atlántico", "codigo" => "08078"], // [cite: 13]
            ["nombre" => "CAMPO DE LA CRUZ - Atlántico", "codigo" => "08137"], // [cite: 13]
            ["nombre" => "CANDELARIA - Atlántico", "codigo" => "08141"], // [cite: 13]
            ["nombre" => "GALAPA - Atlántico", "codigo" => "08296"], // [cite: 13]
            ["nombre" => "JUAN DE ACOSTA - Atlántico", "codigo" => "08372"], // [cite: 13]
            ["nombre" => "LURUACO - Atlántico", "codigo" => "08421"], // [cite: 13]
            ["nombre" => "MALAMBO - Atlántico", "codigo" => "08433"], // [cite: 13]
            ["nombre" => "MANATÍ - Atlántico", "codigo" => "08436"], // [cite: 13]
            ["nombre" => "PALMAR DE VARELA - Atlántico", "codigo" => "08520"], // [cite: 13]
            ["nombre" => "PIOJÓ - Atlántico", "codigo" => "08549"], // [cite: 13]
            ["nombre" => "POLONUEVO - Atlántico", "codigo" => "08558"], // [cite: 13]
            ["nombre" => "PONEDERA - Atlántico", "codigo" => "08560"], // [cite: 13]
            ["nombre" => "PUERTO COLOMBIA - Atlántico", "codigo" => "08573"], // [cite: 13]
            ["nombre" => "REPELÓN - Atlántico", "codigo" => "08606"], // [cite: 13]
            ["nombre" => "SABANAGRANDE - Atlántico", "codigo" => "08634"], // [cite: 13]
            ["nombre" => "SABANALARGA - Atlántico", "codigo" => "08638"], // [cite: 13]
            ["nombre" => "SANTA LUCÍA - Atlántico", "codigo" => "08675"], // [cite: 13]
            ["nombre" => "SANTO TOMÁS - Atlántico", "codigo" => "08685"], // [cite: 13]
            ["nombre" => "SOLEDAD - Atlántico", "codigo" => "08758"], // [cite: 13]
            ["nombre" => "SUAN - Atlántico", "codigo" => "08770"], // [cite: 13]
            ["nombre" => "TUBARÁ - Atlántico", "codigo" => "08832"], // [cite: 13]
            ["nombre" => "USIACURÍ - Atlántico", "codigo" => "08849"], // [cite: 13]

            // --- BOGOTÁ D.C. ---
            ["nombre" => "BOGOTÁ, DC - Cundinamarca", "codigo" => "11001"], // [cite: 13]

            // --- BOLÍVAR ---
            ["nombre" => "CARTAGENA - Bolívar", "codigo" => "13001"], // [cite: 13]
            ["nombre" => "ACHÍ - Bolívar", "codigo" => "13006"], // [cite: 13]
            ["nombre" => "ALTOS DEL ROSARIO - Bolívar", "codigo" => "13030"], // [cite: 13]
            ["nombre" => "ARENAL - Bolívar", "codigo" => "13042"], // [cite: 13]
            ["nombre" => "ARJONA - Bolívar", "codigo" => "13052"], // [cite: 13]
            ["nombre" => "ARROYOHONDO - Bolívar", "codigo" => "13062"], // [cite: 13]
            ["nombre" => "BARRANCO DE LOBA - Bolívar", "codigo" => "13074"], // [cite: 13]
            ["nombre" => "CALAMAR - Bolívar", "codigo" => "13140"], // [cite: 17]
            ["nombre" => "CANTAGALLO - Bolívar", "codigo" => "13160"], // [cite: 17]
            ["nombre" => "CICUCO - Bolívar", "codigo" => "13188"], // [cite: 17]
            ["nombre" => "CÓRDOBA - Bolívar", "codigo" => "13212"], // [cite: 17]
            ["nombre" => "CLEMENCIA - Bolívar", "codigo" => "13222"], // [cite: 17]
            ["nombre" => "EL CARMEN DE BOLÍVAR - Bolívar", "codigo" => "13244"], // [cite: 17]
            ["nombre" => "EL GUAMO - Bolívar", "codigo" => "13248"], // [cite: 17]
            ["nombre" => "EL PEÑÓN - Bolívar", "codigo" => "13268"], // [cite: 17]
            ["nombre" => "HATILLO DE LOBA - Bolívar", "codigo" => "13300"], // [cite: 17]
            ["nombre" => "MAGANGUÉ - Bolívar", "codigo" => "13430"], // [cite: 17]
            ["nombre" => "MAHATES - Bolívar", "codigo" => "13433"], // [cite: 17]
            ["nombre" => "MARGARITA - Bolívar", "codigo" => "13440"], // [cite: 17]
            ["nombre" => "MARÍA LA BAJA - Bolívar", "codigo" => "13442"], // [cite: 17]
            ["nombre" => "MONTECRISTO - Bolívar", "codigo" => "13458"], // [cite: 17]
            ["nombre" => "MOMPÓS - Bolívar", "codigo" => "13468"], // [cite: 17]
            ["nombre" => "MORALES - Bolívar", "codigo" => "13473"], // [cite: 17]
            ["nombre" => "PINILLOS - Bolívar", "codigo" => "13549"], // [cite: 17]
            ["nombre" => "REGIDOR - Bolívar", "codigo" => "13580"], // [cite: 17]
            ["nombre" => "RÍO VIEJO - Bolívar", "codigo" => "13600"], // [cite: 17]
            ["nombre" => "SAN CRISTÓBAL - Bolívar", "codigo" => "13620"], // [cite: 17]
            ["nombre" => "SAN ESTANISLAO - Bolívar", "codigo" => "13647"], // [cite: 17]
            ["nombre" => "SAN FERNANDO - Bolívar", "codigo" => "13650"], // [cite: 17]
            ["nombre" => "SAN JACINTO - Bolívar", "codigo" => "13654"], // [cite: 17]
            ["nombre" => "SAN JACINTO DEL CAUCA - Bolívar", "codigo" => "13655"], // [cite: 17]
            ["nombre" => "SAN JUAN NEPOMUCENO - Bolívar", "codigo" => "13657"], // [cite: 17]
            ["nombre" => "SAN MARTÍN DE LOBA - Bolívar", "codigo" => "13667"], // [cite: 17]
            ["nombre" => "SAN PABLO - Bolívar", "codigo" => "13670"], // [cite: 17]
            ["nombre" => "SANTA CATALINA - Bolívar", "codigo" => "13673"], // [cite: 17]
            ["nombre" => "SANTA ROSA - Bolívar", "codigo" => "13683"], // [cite: 17]
            ["nombre" => "SANTA ROSA DEL SUR - Bolívar", "codigo" => "13688"], // [cite: 17]
            ["nombre" => "SIMITÍ - Bolívar", "codigo" => "13744"], // [cite: 17]
            ["nombre" => "SOPLAVIENTO - Bolívar", "codigo" => "13760"], // [cite: 17]
            ["nombre" => "TALAIGUA NUEVO - Bolívar", "codigo" => "13780"], // [cite: 17]
            ["nombre" => "TIQUISIO - Bolívar", "codigo" => "13810"], // [cite: 17]
            ["nombre" => "TURBACO - Bolívar", "codigo" => "13836"], // [cite: 17]
            ["nombre" => "TURBANÁ - Bolívar", "codigo" => "13838"], // [cite: 17]
            ["nombre" => "VILLANUEVA - Bolívar", "codigo" => "13873"], // [cite: 17]
            ["nombre" => "ZAMBRANO - Bolívar", "codigo" => "13894"], // [cite: 17]

            // --- BOYACÁ ---
            ["nombre" => "TUNJA - Boyacá", "codigo" => "15001"], // [cite: 17]
            ["nombre" => "ALMEIDA - Boyacá", "codigo" => "15022"], // [cite: 17]
            ["nombre" => "AQUITANIA - Boyacá", "codigo" => "15047"], // 
            ["nombre" => "ARCABUCO - Boyacá", "codigo" => "15051"], // 
            ["nombre" => "BELÉN - Boyacá", "codigo" => "15087"], // 
            ["nombre" => "BERBEO - Boyacá", "codigo" => "15090"], // 
            ["nombre" => "BETÉITIVA - Boyacá", "codigo" => "15092"], // 
            ["nombre" => "BOAVITA - Boyacá", "codigo" => "15097"], // 
            ["nombre" => "BOYACÁ - Boyacá", "codigo" => "15104"], // 
            ["nombre" => "BRICEÑO - Boyacá", "codigo" => "15106"], // 
            ["nombre" => "BUENAVISTA - Boyacá", "codigo" => "15109"], // 
            ["nombre" => "BUSBANZÁ - Boyacá", "codigo" => "15114"], // 
            ["nombre" => "CALDAS - Boyacá", "codigo" => "15131"], // 
            ["nombre" => "CAMPOHERMOSO - Boyacá", "codigo" => "15135"], // 
            ["nombre" => "CERINZA - Boyacá", "codigo" => "15162"], // 
            ["nombre" => "CHINAVITA - Boyacá", "codigo" => "15172"], // 
            ["nombre" => "CHIQUINQUIRÁ - Boyacá", "codigo" => "15176"], // 
            ["nombre" => "CHISCAS - Boyacá", "codigo" => "15180"], // 
            ["nombre" => "CHITA - Boyacá", "codigo" => "15183"], // 
            ["nombre" => "CHITARAQUE - Boyacá", "codigo" => "15185"], // 
            ["nombre" => "CHIVATÁ - Boyacá", "codigo" => "15187"], // 
            ["nombre" => "CIÉNEGA - Boyacá", "codigo" => "15189"], // 
            ["nombre" => "COMBITA - Boyacá", "codigo" => "15204"], // 
            ["nombre" => "COPER - Boyacá", "codigo" => "15212"], // 
            ["nombre" => "CORRALES - Boyacá", "codigo" => "15215"], // 
            ["nombre" => "COVARACHÍA - Boyacá", "codigo" => "15218"], // 
            ["nombre" => "CUBARÁ - Boyacá", "codigo" => "15223"], // 
            ["nombre" => "CUCAITA - Boyacá", "codigo" => "15224"], // 
            ["nombre" => "CUÍTIVA - Boyacá", "codigo" => "15226"], // 
            ["nombre" => "CHÍQUIZA - Boyacá", "codigo" => "15232"], // 
            ["nombre" => "CHIVOR - Boyacá", "codigo" => "15236"], // 
            ["nombre" => "DUITAMA - Boyacá", "codigo" => "15238"], // 
            ["nombre" => "EL COCUY - Boyacá", "codigo" => "15244"], // 
            ["nombre" => "EL ESPINO - Boyacá", "codigo" => "15248"], // 
            ["nombre" => "FIRAVITOBA - Boyacá", "codigo" => "15272"], // 
            ["nombre" => "FLORESTA - Boyacá", "codigo" => "15276"], // 
            ["nombre" => "GACHANTIVÁ - Boyacá", "codigo" => "15293"], // 
            ["nombre" => "GAMEZA - Boyacá", "codigo" => "15296"], // 
            ["nombre" => "GARAGOA - Boyacá", "codigo" => "15299"], // 
            ["nombre" => "GUACAMAYAS - Boyacá", "codigo" => "15317"], // 
            ["nombre" => "GUATEQUE - Boyacá", "codigo" => "15322"], // 
            ["nombre" => "GUAYATÁ - Boyacá", "codigo" => "15325"], // 
            ["nombre" => "GÜICÁN - Boyacá", "codigo" => "15332"], // [cite: 25]
            ["nombre" => "IZA - Boyacá", "codigo" => "15362"], // [cite: 25]
            ["nombre" => "JENESANO - Boyacá", "codigo" => "15367"], // [cite: 25]
            ["nombre" => "JERICÓ - Boyacá", "codigo" => "15368"], // [cite: 25]
            ["nombre" => "LABRANZAGRANDE - Boyacá", "codigo" => "15377"], // [cite: 25]
            ["nombre" => "LA CAPILLA - Boyacá", "codigo" => "15380"], // [cite: 25]
            ["nombre" => "LA VICTORIA - Boyacá", "codigo" => "15401"], // [cite: 25]
            ["nombre" => "LA UVITA - Boyacá", "codigo" => "15403"], // [cite: 25]
            ["nombre" => "VILLA DE LEYVA - Boyacá", "codigo" => "15407"], // [cite: 25]
            ["nombre" => "MACANAL - Boyacá", "codigo" => "15425"], // [cite: 25]
            ["nombre" => "MARIPÍ - Boyacá", "codigo" => "15442"], // [cite: 25]
            ["nombre" => "MIRAFLORES - Boyacá", "codigo" => "15455"], // [cite: 25]
            ["nombre" => "MONGUA - Boyacá", "codigo" => "15464"], // [cite: 25]
            ["nombre" => "MONGUÍ - Boyacá", "codigo" => "15466"], // [cite: 25]
            ["nombre" => "MONIQUIRÁ - Boyacá", "codigo" => "15469"], // [cite: 25]
            ["nombre" => "MOTAVITA - Boyacá", "codigo" => "15476"], // [cite: 25]
            ["nombre" => "MUZO - Boyacá", "codigo" => "15480"], // [cite: 25]
            ["nombre" => "NOBSA - Boyacá", "codigo" => "15491"], // [cite: 25]
            ["nombre" => "NUEVO COLÓN - Boyacá", "codigo" => "15494"], // [cite: 25]
            ["nombre" => "OICATÁ - Boyacá", "codigo" => "15500"], // [cite: 25]
            ["nombre" => "OTANCHE - Boyacá", "codigo" => "15507"], // [cite: 25]
            ["nombre" => "PACHAVITA - Boyacá", "codigo" => "15511"], // [cite: 25]
            ["nombre" => "PÁEZ - Boyacá", "codigo" => "15514"], // [cite: 25]
            ["nombre" => "PAIPA - Boyacá", "codigo" => "15516"], // [cite: 25]
            ["nombre" => "PAJARITO - Boyacá", "codigo" => "15518"], // [cite: 25]
            ["nombre" => "PANQUEBA - Boyacá", "codigo" => "15522"], // [cite: 25]
            ["nombre" => "PAUNA - Boyacá", "codigo" => "15531"], // [cite: 25]
            ["nombre" => "PAYA - Boyacá", "codigo" => "15533"], // [cite: 25]
            ["nombre" => "PAZ DE RÍO - Boyacá", "codigo" => "15537"], // [cite: 25]
            ["nombre" => "PESCA - Boyacá", "codigo" => "15542"], // [cite: 25]
            ["nombre" => "PISBA - Boyacá", "codigo" => "15550"], // [cite: 25]
            ["nombre" => "PUERTO BOYACÁ - Boyacá", "codigo" => "15572"], // [cite: 25]
            ["nombre" => "QUÍPAMA - Boyacá", "codigo" => "15580"], // [cite: 25]
            ["nombre" => "RAMIRIQUÍ - Boyacá", "codigo" => "15599"], // [cite: 25]
            ["nombre" => "RÁQUIRA - Boyacá", "codigo" => "15600"], // [cite: 25]
            ["nombre" => "RONDÓN - Boyacá", "codigo" => "15621"], // [cite: 25]
            ["nombre" => "SABOYÁ - Boyacá", "codigo" => "15632"], // [cite: 25]
            ["nombre" => "SÁCHICA - Boyacá", "codigo" => "15638"], // [cite: 25]
            ["nombre" => "SAMACÁ - Boyacá", "codigo" => "15646"], // [cite: 25]
            ["nombre" => "SAN EDUARDO - Boyacá", "codigo" => "15660"], // [cite: 25]
            ["nombre" => "SAN JOSÉ DE PARE - Boyacá", "codigo" => "15664"], // [cite: 29]
            ["nombre" => "SAN LUIS DE GACENO - Boyacá", "codigo" => "15667"], // [cite: 29]
            ["nombre" => "SAN MATEO - Boyacá", "codigo" => "15673"], // [cite: 29]
            ["nombre" => "SAN MIGUEL DE SEMA - Boyacá", "codigo" => "15676"], // [cite: 29]
            ["nombre" => "SAN PABLO DE BORBUR - Boyacá", "codigo" => "15681"], // [cite: 29]
            ["nombre" => "SANTANA - Boyacá", "codigo" => "15686"], // [cite: 29]
            ["nombre" => "SANTA MARÍA - Boyacá", "codigo" => "15690"], // [cite: 29]
            ["nombre" => "SANTA ROSA DE VITERBO - Boyacá", "codigo" => "15693"], // [cite: 29]
            ["nombre" => "SANTA SOFÍA - Boyacá", "codigo" => "15696"], // [cite: 29]
            ["nombre" => "SATIVANORTE - Boyacá", "codigo" => "15720"], // [cite: 29]
            ["nombre" => "SATIVASUR - Boyacá", "codigo" => "15723"], // [cite: 29]
            ["nombre" => "SIACHOQUE - Boyacá", "codigo" => "15740"], // [cite: 29]
            ["nombre" => "SOATÁ - Boyacá", "codigo" => "15753"], // [cite: 29]
            ["nombre" => "SOCOTÁ - Boyacá", "codigo" => "15755"], // [cite: 29]
            ["nombre" => "SOCHA - Boyacá", "codigo" => "15757"], // [cite: 29]
            ["nombre" => "SOGAMOSO - Boyacá", "codigo" => "15759"], // [cite: 29]
            ["nombre" => "SOMONDOCO - Boyacá", "codigo" => "15761"], // [cite: 29]
            ["nombre" => "SORA - Boyacá", "codigo" => "15762"], // [cite: 29]
            ["nombre" => "SOTAQUIRÁ - Boyacá", "codigo" => "15763"], // [cite: 29]
            ["nombre" => "SORACÁ - Boyacá", "codigo" => "15764"], // [cite: 29]
            ["nombre" => "SUSACÓN - Boyacá", "codigo" => "15774"], // [cite: 29]
            ["nombre" => "SUTAMARCHÁN - Boyacá", "codigo" => "15776"], // [cite: 29]
            ["nombre" => "SUTATENZA - Boyacá", "codigo" => "15778"], // [cite: 29]
            ["nombre" => "TASCO - Boyacá", "codigo" => "15790"], // [cite: 29]
            ["nombre" => "TENZA - Boyacá", "codigo" => "15798"], // [cite: 29]
            ["nombre" => "TIBANÁ - Boyacá", "codigo" => "15804"], // [cite: 29]
            ["nombre" => "TIBASOSA - Boyacá", "codigo" => "15806"], // [cite: 29]
            ["nombre" => "TINJACÁ - Boyacá", "codigo" => "15808"], // [cite: 29]
            ["nombre" => "TIPACOQUE - Boyacá", "codigo" => "15810"], // [cite: 29]
            ["nombre" => "TOCA - Boyacá", "codigo" => "15814"], // [cite: 29]
            ["nombre" => "TOGÜÍ - Boyacá", "codigo" => "15816"], // [cite: 29]
            ["nombre" => "TÓPAGA - Boyacá", "codigo" => "15820"], // [cite: 29]
            ["nombre" => "TOTA - Boyacá", "codigo" => "15822"], // [cite: 29]
            ["nombre" => "TUNUNGUÁ - Boyacá", "codigo" => "15832"], // [cite: 29]
            ["nombre" => "TURMEQUÉ - Boyacá", "codigo" => "15835"], // [cite: 29]
            ["nombre" => "TUTA - Boyacá", "codigo" => "15837"], // [cite: 29]
            ["nombre" => "TUTAZÁ - Boyacá", "codigo" => "15839"], // [cite: 29]
            ["nombre" => "UMBITA - Boyacá", "codigo" => "15842"], // [cite: 29]
            ["nombre" => "VENTAQUEMADA - Boyacá", "codigo" => "15861"], // [cite: 29]
            ["nombre" => "VIRACACHÁ - Boyacá", "codigo" => "15879"], // [cite: 29]
            ["nombre" => "ZETAQUIRA - Boyacá", "codigo" => "15897"], // [cite: 33]

            // --- CALDAS ---
            ["nombre" => "MANIZALES - Caldas", "codigo" => "17001"], // [cite: 33]
            ["nombre" => "AGUADAS - Caldas", "codigo" => "17013"], // [cite: 33]
            ["nombre" => "ANSERMA - Caldas", "codigo" => "17042"], // [cite: 33]
            ["nombre" => "ARANZAZU - Caldas", "codigo" => "17050"], // [cite: 33]
            ["nombre" => "BELALCÁZAR - Caldas", "codigo" => "17088"], // [cite: 33]
            ["nombre" => "CHINCHINÁ - Caldas", "codigo" => "17174"], // [cite: 33]
            ["nombre" => "FILADELFIA - Caldas", "codigo" => "17272"], // [cite: 33]
            ["nombre" => "LA DORADA - Caldas", "codigo" => "17380"], // [cite: 33]
            ["nombre" => "LA MERCED - Caldas", "codigo" => "17388"], // [cite: 33]
            ["nombre" => "MANZANARES - Caldas", "codigo" => "17433"], // [cite: 33]
            ["nombre" => "MARMATO - Caldas", "codigo" => "17442"], // [cite: 33]
            ["nombre" => "MARQUETALIA - Caldas", "codigo" => "17444"], // [cite: 33]
            ["nombre" => "MARULANDA - Caldas", "codigo" => "17446"], // [cite: 33]
            ["nombre" => "NEIRA - Caldas", "codigo" => "17486"], // [cite: 33]
            ["nombre" => "NORCASIA - Caldas", "codigo" => "17495"], // [cite: 33]
            ["nombre" => "PÁCORA - Caldas", "codigo" => "17513"], // [cite: 33]
            ["nombre" => "PALESTINA - Caldas", "codigo" => "17524"], // [cite: 33]
            ["nombre" => "PENSILVANIA - Caldas", "codigo" => "17541"], // [cite: 33]
            ["nombre" => "RIOSUCIO - Caldas", "codigo" => "17614"], // [cite: 33]
            ["nombre" => "RISARALDA - Caldas", "codigo" => "17616"], // [cite: 33]
            ["nombre" => "SALAMINA - Caldas", "codigo" => "17653"], // [cite: 33]
            ["nombre" => "SAMANÁ - Caldas", "codigo" => "17662"], // [cite: 33]
            ["nombre" => "SAN JOSÉ - Caldas", "codigo" => "17665"], // [cite: 33]
            ["nombre" => "SUPÍA - Caldas", "codigo" => "17777"], // [cite: 33]
            ["nombre" => "VICTORIA - Caldas", "codigo" => "17867"], // [cite: 33]
            ["nombre" => "VILLAMARÍA - Caldas", "codigo" => "17873"], // [cite: 33]
            ["nombre" => "VITERBO - Caldas", "codigo" => "17877"], // [cite: 33]

            // --- CAQUETÁ ---
            ["nombre" => "FLORENCIA - Caquetá", "codigo" => "18001"], // [cite: 33]
            ["nombre" => "ALBANIA - Caquetá", "codigo" => "18029"], // [cite: 33]
            ["nombre" => "BELÉN DE LOS ANDAQUIES - Caquetá", "codigo" => "18094"], // [cite: 33]
            ["nombre" => "CARTAGENA DEL CHAIRÁ - Caquetá", "codigo" => "18150"], // [cite: 33]
            ["nombre" => "CURILLO - Caquetá", "codigo" => "18205"], // [cite: 33]
            ["nombre" => "EL DONCELLO - Caquetá", "codigo" => "18247"], // [cite: 33]
            ["nombre" => "EL PAUJIL - Caquetá", "codigo" => "18256"], // [cite: 33]
            ["nombre" => "LA MONTAÑITA - Caquetá", "codigo" => "18410"], // [cite: 33]
            ["nombre" => "MILÁN - Caquetá", "codigo" => "18460"], // [cite: 33]
            ["nombre" => "MORELIA - Caquetá", "codigo" => "18479"], // [cite: 33]
            ["nombre" => "PUERTO RICO - Caquetá", "codigo" => "18592"], // [cite: 33]
            ["nombre" => "SAN JOSÉ DEL FRAGUA - Caquetá", "codigo" => "18610"], // [cite: 33]
            ["nombre" => "SAN VICENTE DEL CAGUÁN - Caquetá", "codigo" => "18753"], // [cite: 37]
            ["nombre" => "SOLANO - Caquetá", "codigo" => "18756"], // [cite: 37]
            ["nombre" => "SOLITA - Caquetá", "codigo" => "18785"], // [cite: 37]
            ["nombre" => "VALPARAÍSO - Caquetá", "codigo" => "18860"], // [cite: 37]

            // --- CAUCA ---
            ["nombre" => "POPAYÁN - Cauca", "codigo" => "19001"], // [cite: 37]
            ["nombre" => "ALMAGUER - Cauca", "codigo" => "19022"], // [cite: 37]
            ["nombre" => "ARGELIA - Cauca", "codigo" => "19050"], // [cite: 37]
            ["nombre" => "BALBOA - Cauca", "codigo" => "19075"], // [cite: 37]
            ["nombre" => "BOLÍVAR - Cauca", "codigo" => "19100"], // [cite: 37]
            ["nombre" => "BUENOS AIRES - Cauca", "codigo" => "19110"], // [cite: 37]
            ["nombre" => "CAJIBÍO - Cauca", "codigo" => "19130"], // [cite: 37]
            ["nombre" => "CALDONO - Cauca", "codigo" => "19137"], // [cite: 37]
            ["nombre" => "CALOTO - Cauca", "codigo" => "19142"], // [cite: 37]
            ["nombre" => "CORINTO - Cauca", "codigo" => "19212"], // [cite: 37]
            ["nombre" => "EL TAMBO - Cauca", "codigo" => "19256"], // [cite: 37]
            ["nombre" => "FLORENCIA - Cauca", "codigo" => "19290"], // [cite: 37]
            ["nombre" => "GUACHENÉ - Cauca", "codigo" => "19300"], // [cite: 37]
            ["nombre" => "GUAPI - Cauca", "codigo" => "19318"], // [cite: 37]
            ["nombre" => "INZÁ - Cauca", "codigo" => "19355"], // [cite: 37]
            ["nombre" => "JAMBALÓ - Cauca", "codigo" => "19364"], // [cite: 37]
            ["nombre" => "LA SIERRA - Cauca", "codigo" => "19392"], // [cite: 37]
            ["nombre" => "LA VEGA - Cauca", "codigo" => "19397"], // [cite: 37]
            ["nombre" => "LÓPEZ - Cauca", "codigo" => "19418"], // [cite: 37]
            ["nombre" => "MERCADERES - Cauca", "codigo" => "19450"], // [cite: 37]
            ["nombre" => "MIRANDA - Cauca", "codigo" => "19455"], // [cite: 37]
            ["nombre" => "MORALES - Cauca", "codigo" => "19473"], // [cite: 37]
            ["nombre" => "PADILLA - Cauca", "codigo" => "19513"], // [cite: 37]
            ["nombre" => "PAEZ - Cauca", "codigo" => "19517"], // [cite: 37]
            ["nombre" => "PATÍA - Cauca", "codigo" => "19532"], // [cite: 37]
            ["nombre" => "PIAMONTE - Cauca", "codigo" => "19533"], // [cite: 37]
            ["nombre" => "PIENDAMÓ - Cauca", "codigo" => "19548"], // [cite: 37]
            ["nombre" => "PUERTO TEJADA - Cauca", "codigo" => "19573"], // [cite: 37]
            ["nombre" => "PURACÉ - Cauca", "codigo" => "19585"], // [cite: 37]
            ["nombre" => "ROSAS - Cauca", "codigo" => "19622"], // [cite: 37]
            ["nombre" => "SAN SEBASTIAN - Cauca", "codigo" => "19693"], // [cite: 37]
            ["nombre" => "SANTANDER DE QUILICHAO - Cauca", "codigo" => "19698"], // [cite: 37]
            ["nombre" => "SANTA ROSA - Cauca", "codigo" => "19701"], // [cite: 37]
            ["nombre" => "SILVIA - Cauca", "codigo" => "19743"], // [cite: 37]
            ["nombre" => "SOTARA - Cauca", "codigo" => "19760"], // [cite: 37]
            ["nombre" => "SUÁREZ - Cauca", "codigo" => "19780"], // [cite: 37]
            ["nombre" => "SUCRE - Cauca", "codigo" => "19785"], // [cite: 41]
            ["nombre" => "TIMBÍO - Cauca", "codigo" => "19807"], // [cite: 41]
            ["nombre" => "TIMBIQUÍ - Cauca", "codigo" => "19809"], // [cite: 41]
            ["nombre" => "TORIBIO - Cauca", "codigo" => "19821"], // [cite: 41]
            ["nombre" => "TOTORÓ - Cauca", "codigo" => "19824"], // [cite: 41]
            ["nombre" => "VILLA RICA - Cauca", "codigo" => "19845"], // [cite: 41]

            // --- CESAR ---
            ["nombre" => "VALLEDUPAR - Cesar", "codigo" => "20001"], // [cite: 41]
            ["nombre" => "AGUACHICA - Cesar", "codigo" => "20011"], // [cite: 41]
            ["nombre" => "AGUSTÍN CODAZZI - Cesar", "codigo" => "20013"], // [cite: 41]
            ["nombre" => "ASTREA - Cesar", "codigo" => "20032"], // [cite: 41]
            ["nombre" => "BECERRIL - Cesar", "codigo" => "20045"], // [cite: 41]
            ["nombre" => "BOSCONIA - Cesar", "codigo" => "20060"], // [cite: 41]
            ["nombre" => "CHIMICHAGUA - Cesar", "codigo" => "20175"], // [cite: 41]
            ["nombre" => "CHIRIGUANÁ - Cesar", "codigo" => "20178"], // [cite: 41]
            ["nombre" => "CURUMANÍ - Cesar", "codigo" => "20228"], // [cite: 41]
            ["nombre" => "EL COPEY - Cesar", "codigo" => "20238"], // [cite: 41]
            ["nombre" => "EL PASO - Cesar", "codigo" => "20250"], // [cite: 41]
            ["nombre" => "GAMARRA - Cesar", "codigo" => "20295"], // [cite: 41]
            ["nombre" => "GONZÁLEZ - Cesar", "codigo" => "20310"], // [cite: 41]
            ["nombre" => "LA GLORIA - Cesar", "codigo" => "20383"], // [cite: 41]
            ["nombre" => "LA JAGUA DE IBIRICO - Cesar", "codigo" => "20400"], // [cite: 41]
            ["nombre" => "MANAURE - Cesar", "codigo" => "20443"], // [cite: 41]
            ["nombre" => "PAILITAS - Cesar", "codigo" => "20517"], // [cite: 41]
            ["nombre" => "PELAYA - Cesar", "codigo" => "20550"], // [cite: 41]
            ["nombre" => "PUEBLO BELLO - Cesar", "codigo" => "20570"], // [cite: 41]
            ["nombre" => "RÍO DE ORO - Cesar", "codigo" => "20614"], // [cite: 41]
            ["nombre" => "LA PAZ - Cesar", "codigo" => "20621"], // [cite: 41]
            ["nombre" => "SAN ALBERTO - Cesar", "codigo" => "20710"], // [cite: 41]
            ["nombre" => "SAN DIEGO - Cesar", "codigo" => "20750"], // [cite: 41]
            ["nombre" => "SAN MARTÍN - Cesar", "codigo" => "20770"], // [cite: 41]
            ["nombre" => "TAMALAMEQUE - Cesar", "codigo" => "20787"], // [cite: 41]

            // --- CÓRDOBA ---
            ["nombre" => "MONTERÍA - Córdoba", "codigo" => "23001"], // [cite: 41]
            ["nombre" => "AYAPEL - Córdoba", "codigo" => "23068"], // [cite: 41]
            ["nombre" => "BUENAVISTA - Córdoba", "codigo" => "23079"], // [cite: 41]
            ["nombre" => "CANALETE - Córdoba", "codigo" => "23090"], // [cite: 41]
            ["nombre" => "CERETÉ - Córdoba", "codigo" => "23162"], // [cite: 41]
            ["nombre" => "CHIMÁ - Córdoba", "codigo" => "23168"], // [cite: 41]
            ["nombre" => "CHINÚ - Córdoba", "codigo" => "23182"], // [cite: 41]
            ["nombre" => "CIÉNAGA DE ORO - Córdoba", "codigo" => "23189"], // [cite: 41]
            ["nombre" => "COTORRA - Córdoba", "codigo" => "23300"], // [cite: 41]
            ["nombre" => "LA APARTADA - Córdoba", "codigo" => "23350"], // [cite: 42]
            ["nombre" => "LORICA - Córdoba", "codigo" => "23417"], // [cite: 42]
            ["nombre" => "LOS CÓRDOBAS - Córdoba", "codigo" => "23419"], // [cite: 42]
            ["nombre" => "MOMIL - Córdoba", "codigo" => "23464"], // [cite: 42]
            ["nombre" => "MONTELÍBANO - Córdoba", "codigo" => "23466"], // [cite: 42]
            ["nombre" => "MOÑITOS - Córdoba", "codigo" => "23500"], // [cite: 42]
            ["nombre" => "PLANETA RICA - Córdoba", "codigo" => "23555"], // [cite: 42]
            ["nombre" => "PUEBLO NUEVO - Córdoba", "codigo" => "23570"], // [cite: 42]
            ["nombre" => "PUERTO ESCONDIDO - Córdoba", "codigo" => "23574"], // [cite: 42]
            ["nombre" => "PUERTO LIBERTADOR - Córdoba", "codigo" => "23580"], // [cite: 42]
            ["nombre" => "PURÍSIMA - Córdoba", "codigo" => "23586"], // [cite: 42]
            ["nombre" => "SAHAGÚN - Córdoba", "codigo" => "23660"], // [cite: 42]
            ["nombre" => "SAN ANDRÉS SOTAVENTO - Córdoba", "codigo" => "23670"], // [cite: 42]
            ["nombre" => "SAN ANTERO - Córdoba", "codigo" => "23672"], // [cite: 42]
            ["nombre" => "SAN BERNARDO DEL VIENTO - Córdoba", "codigo" => "23675"], // [cite: 42]
            ["nombre" => "SAN CARLOS - Córdoba", "codigo" => "23678"], // [cite: 42]
            ["nombre" => "SAN PELAYO - Córdoba", "codigo" => "23686"], // [cite: 42]
            ["nombre" => "TIERRALTA - Córdoba", "codigo" => "23807"], // [cite: 42]
            ["nombre" => "VALENCIA - Córdoba", "codigo" => "23855"], // [cite: 42]

            // --- CUNDINAMARCA ---
            ["nombre" => "AGUA DE DIOS - Cundinamarca", "codigo" => "25001"], // [cite: 42]
            ["nombre" => "ALBÁN - Cundinamarca", "codigo" => "25019"], // [cite: 42]
            ["nombre" => "ANAPOIMA - Cundinamarca", "codigo" => "25035"], // [cite: 42]
            ["nombre" => "ANOLAIMA - Cundinamarca", "codigo" => "25040"], // [cite: 42]
            ["nombre" => "ARBELÁEZ - Cundinamarca", "codigo" => "25053"], // [cite: 42]
            ["nombre" => "BELTRÁN - Cundinamarca", "codigo" => "25086"], // [cite: 42]
            ["nombre" => "BITUIMA - Cundinamarca", "codigo" => "25095"], // [cite: 42]
            ["nombre" => "BOJACÁ - Cundinamarca", "codigo" => "25099"], // [cite: 42]
            ["nombre" => "CABRERA - Cundinamarca", "codigo" => "25120"], // [cite: 42]
            ["nombre" => "CACHIPAY - Cundinamarca", "codigo" => "25123"], // [cite: 42]
            ["nombre" => "CAJICÁ - Cundinamarca", "codigo" => "25126"], // [cite: 42]
            ["nombre" => "CAPARRAPÍ - Cundinamarca", "codigo" => "25148"], // [cite: 42]
            ["nombre" => "CAQUEZA - Cundinamarca", "codigo" => "25151"], // [cite: 42]
            ["nombre" => "CARMEN DE CARUPA - Cundinamarca", "codigo" => "25154"], // [cite: 42]
            ["nombre" => "CHAGUANÍ - Cundinamarca", "codigo" => "25168"], // [cite: 42]
            ["nombre" => "CHÍA - Cundinamarca", "codigo" => "25175"], // [cite: 42]
            ["nombre" => "CHIPAQUE - Cundinamarca", "codigo" => "25178"], // [cite: 42]
            ["nombre" => "CHOACHÍ - Cundinamarca", "codigo" => "25181"], // [cite: 42]
            ["nombre" => "CHOCONTÁ - Cundinamarca", "codigo" => "25183"], // [cite: 42]
            ["nombre" => "COGUA - Cundinamarca", "codigo" => "25200"], // [cite: 42]
            ["nombre" => "COTA - Cundinamarca", "codigo" => "25214"], // [cite: 42]
            ["nombre" => "CUCUNUBÁ - Cundinamarca", "codigo" => "25224"], // [cite: 44]
            ["nombre" => "EL COLEGIO - Cundinamarca", "codigo" => "25245"], // [cite: 44]
            ["nombre" => "EL PEÑÓN - Cundinamarca", "codigo" => "25258"], // [cite: 44]
            ["nombre" => "EL ROSAL - Cundinamarca", "codigo" => "25260"], // [cite: 44]
            ["nombre" => "FACATATIVÁ - Cundinamarca", "codigo" => "25269"], // [cite: 44]
            ["nombre" => "FOMEQUE - Cundinamarca", "codigo" => "25279"], // [cite: 44]
            ["nombre" => "FOSCA - Cundinamarca", "codigo" => "25281"], // [cite: 44]
            ["nombre" => "FUNZA - Cundinamarca", "codigo" => "25286"], // [cite: 44]
            ["nombre" => "FÚQUENE - Cundinamarca", "codigo" => "25288"], // [cite: 44]
            ["nombre" => "FUSAGASUGÁ - Cundinamarca", "codigo" => "25290"], // [cite: 44]
            ["nombre" => "GACHALA - Cundinamarca", "codigo" => "25293"], // [cite: 44]
            ["nombre" => "GACHANCIPÁ - Cundinamarca", "codigo" => "25295"], // [cite: 44]
            ["nombre" => "GACHETÁ - Cundinamarca", "codigo" => "25297"], // [cite: 44]
            ["nombre" => "GAMA - Cundinamarca", "codigo" => "25299"], // [cite: 44]
            ["nombre" => "GIRARDOT - Cundinamarca", "codigo" => "25307"], // [cite: 44]
            ["nombre" => "GRANADA - Cundinamarca", "codigo" => "25312"], // [cite: 44]
            ["nombre" => "GUACHETÁ - Cundinamarca", "codigo" => "25317"], // [cite: 44]
            ["nombre" => "GUADUAS - Cundinamarca", "codigo" => "25320"], // [cite: 44]
            ["nombre" => "GUASCA - Cundinamarca", "codigo" => "25322"], // [cite: 44]
            ["nombre" => "GUATAQUÍ - Cundinamarca", "codigo" => "25324"], // [cite: 44]
            ["nombre" => "GUATAVITA - Cundinamarca", "codigo" => "25326"], // [cite: 44]
            ["nombre" => "GUAYABAL DE SIQUIMA - Cundinamarca", "codigo" => "25328"], // [cite: 44]
            ["nombre" => "GUAYABETAL - Cundinamarca", "codigo" => "25335"], // [cite: 44]
            ["nombre" => "GUTIÉRREZ - Cundinamarca", "codigo" => "25339"], // [cite: 44]
            ["nombre" => "JERUSALÉN - Cundinamarca", "codigo" => "25368"], // [cite: 44]
            ["nombre" => "JUNÍN - Cundinamarca", "codigo" => "25372"], // [cite: 44]
            ["nombre" => "LA CALERA - Cundinamarca", "codigo" => "25377"], // [cite: 44]
            ["nombre" => "LA MESA - Cundinamarca", "codigo" => "25386"], // [cite: 44]
            ["nombre" => "LA PALMA - Cundinamarca", "codigo" => "25394"], // [cite: 44]
            ["nombre" => "LA PEÑA - Cundinamarca", "codigo" => "25398"], // [cite: 44]
            ["nombre" => "LA VEGA - Cundinamarca", "codigo" => "25402"], // [cite: 44]
            ["nombre" => "LENGUAZAQUE - Cundinamarca", "codigo" => "25407"], // [cite: 44]
            ["nombre" => "MACHETA - Cundinamarca", "codigo" => "25426"], // [cite: 44]
            ["nombre" => "MADRID - Cundinamarca", "codigo" => "25430"], // [cite: 44]
            ["nombre" => "MANTA - Cundinamarca", "codigo" => "25436"], // [cite: 44]
            ["nombre" => "MEDINA - Cundinamarca", "codigo" => "25438"], // [cite: 44]
            ["nombre" => "MOSQUERA - Cundinamarca", "codigo" => "25473"], // [cite: 44]
            ["nombre" => "NARIÑO - Cundinamarca", "codigo" => "25483"], // [cite: 44]
            ["nombre" => "NEMOCÓN - Cundinamarca", "codigo" => "25486"], // [cite: 44]
            ["nombre" => "NILO - Cundinamarca", "codigo" => "25488"], // [cite: 44]
            ["nombre" => "NIMAIMA - Cundinamarca", "codigo" => "25489"], // [cite: 45]
            ["nombre" => "NOCAIMA - Cundinamarca", "codigo" => "25491"], // [cite: 45]
            ["nombre" => "VENECIA - Cundinamarca", "codigo" => "25506"], // [cite: 45]
            ["nombre" => "PACHO - Cundinamarca", "codigo" => "25513"], // [cite: 45]
            ["nombre" => "PAIME - Cundinamarca", "codigo" => "25518"], // [cite: 45]
            ["nombre" => "PANDI - Cundinamarca", "codigo" => "25524"], // [cite: 45]
            ["nombre" => "PARATEBUENO - Cundinamarca", "codigo" => "25530"], // [cite: 45]
            ["nombre" => "PASCA - Cundinamarca", "codigo" => "25535"], // [cite: 45]
            ["nombre" => "PUERTO SALGAR - Cundinamarca", "codigo" => "25572"], // [cite: 45]
            ["nombre" => "PULÍ - Cundinamarca", "codigo" => "25580"], // [cite: 45]
            ["nombre" => "QUEBRADANEGRA - Cundinamarca", "codigo" => "25592"], // [cite: 45]
            ["nombre" => "QUETAME - Cundinamarca", "codigo" => "25594"], // [cite: 45]
            ["nombre" => "QUIPILE - Cundinamarca", "codigo" => "25596"], // [cite: 45]
            ["nombre" => "APULO - Cundinamarca", "codigo" => "25599"], // [cite: 45]
            ["nombre" => "RICAURTE - Cundinamarca", "codigo" => "25612"], // [cite: 45]
            ["nombre" => "SAN ANTONIO DEL TEQUENDAMA - Cundinamarca", "codigo" => "25645"], // [cite: 45]
            ["nombre" => "SAN BERNARDO - Cundinamarca", "codigo" => "25649"], // [cite: 45]
            ["nombre" => "SAN CAYETANO - Cundinamarca", "codigo" => "25653"], // [cite: 45]
            ["nombre" => "SAN FRANCISCO - Cundinamarca", "codigo" => "25658"], // [cite: 45]
            ["nombre" => "SAN JUAN DE RÍO SECO - Cundinamarca", "codigo" => "25662"], // [cite: 45]
            ["nombre" => "SASAIMA - Cundinamarca", "codigo" => "25718"], // [cite: 45]
            ["nombre" => "SESQUILÉ - Cundinamarca", "codigo" => "25736"], // [cite: 45]
            ["nombre" => "SIBATÉ - Cundinamarca", "codigo" => "25740"], // [cite: 45]
            ["nombre" => "SILVANIA - Cundinamarca", "codigo" => "25743"], // [cite: 45]
            ["nombre" => "SIMIJACA - Cundinamarca", "codigo" => "25745"], // [cite: 45]
            ["nombre" => "SOACHA - Cundinamarca", "codigo" => "25754"], // [cite: 45]
            ["nombre" => "SOPÓ - Cundinamarca", "codigo" => "25758"], // [cite: 45]
            ["nombre" => "SUBACHOQUE - Cundinamarca", "codigo" => "25769"], // [cite: 45]
            ["nombre" => "SUESCA - Cundinamarca", "codigo" => "25772"], // [cite: 45]
            ["nombre" => "SUPATÁ - Cundinamarca", "codigo" => "25777"], // [cite: 45]
            ["nombre" => "SUSA - Cundinamarca", "codigo" => "25779"], // [cite: 45]
            ["nombre" => "SUTATAUSA - Cundinamarca", "codigo" => "25781"], // [cite: 45]
            ["nombre" => "TABIO - Cundinamarca", "codigo" => "25785"], // [cite: 45]
            ["nombre" => "TAUSA - Cundinamarca", "codigo" => "25793"], // [cite: 45]
            ["nombre" => "TENA - Cundinamarca", "codigo" => "25797"], // [cite: 45]
            ["nombre" => "TENJO - Cundinamarca", "codigo" => "25799"], // [cite: 45]
            ["nombre" => "TIBACUY - Cundinamarca", "codigo" => "25805"], // [cite: 45]
            ["nombre" => "TIBIRITA - Cundinamarca", "codigo" => "25807"], // [cite: 45]
            ["nombre" => "TOCAIMA - Cundinamarca", "codigo" => "25815"], // [cite: 45]
            ["nombre" => "TOCANCIPÁ - Cundinamarca", "codigo" => "25817"], // [cite: 45]
            ["nombre" => "TOPAIPÍ - Cundinamarca", "codigo" => "25823"], // [cite: 46]
            ["nombre" => "UBALÁ - Cundinamarca", "codigo" => "25839"], // [cite: 46]
            ["nombre" => "UBAQUE - Cundinamarca", "codigo" => "25841"], // [cite: 46]
            ["nombre" => "VILLA DE SAN DIEGO DE UBATE - Cundinamarca", "codigo" => "25843"], // [cite: 46]
            ["nombre" => "UNE - Cundinamarca", "codigo" => "25845"], // [cite: 46]
            ["nombre" => "ÚTICA - Cundinamarca", "codigo" => "25851"], // [cite: 46]
            ["nombre" => "VERGARA - Cundinamarca", "codigo" => "25862"], // [cite: 46]
            ["nombre" => "VIANÍ - Cundinamarca", "codigo" => "25867"], // [cite: 46]
            ["nombre" => "VILLAGÓMEZ - Cundinamarca", "codigo" => "25871"], // [cite: 46]
            ["nombre" => "VILLAPINZÓN - Cundinamarca", "codigo" => "25873"], // [cite: 46]
            ["nombre" => "VILLETA - Cundinamarca", "codigo" => "25875"], // [cite: 46]
            ["nombre" => "VIOTÁ - Cundinamarca", "codigo" => "25878"], // [cite: 46]
            ["nombre" => "YACOPÍ - Cundinamarca", "codigo" => "25885"], // [cite: 46]
            ["nombre" => "ZIPACÓN - Cundinamarca", "codigo" => "25898"], // [cite: 46]
            ["nombre" => "ZIPAQUIRÁ - Cundinamarca", "codigo" => "25899"], // [cite: 46]

            // --- CHOCÓ ---
            ["nombre" => "QUIBDÓ - Chocó", "codigo" => "27001"], // [cite: 46]
            ["nombre" => "ACANDÍ - Chocó", "codigo" => "27006"], // [cite: 46]
            ["nombre" => "ALTO BAUDO - Chocó", "codigo" => "27025"], // [cite: 46]
            ["nombre" => "ATRATO - Chocó", "codigo" => "27050"], // [cite: 46]
            ["nombre" => "BAGADÓ - Chocó", "codigo" => "27073"], // [cite: 46]
            ["nombre" => "BAHÍA SOLANO - Chocó", "codigo" => "27075"], // [cite: 46]
            ["nombre" => "BAJO BAUDÓ - Chocó", "codigo" => "27077"], // [cite: 46]
            ["nombre" => "BELÉN DE BAJIRÁ - Chocó", "codigo" => "27086"], // [cite: 46]
            ["nombre" => "BOJAYA - Chocó", "codigo" => "27099"], // [cite: 46]
            ["nombre" => "EL CANTÓN DEL SAN PABLO - Chocó", "codigo" => "27135"], // [cite: 46]
            ["nombre" => "CARMEN DEL DARIEN - Chocó", "codigo" => "27150"], // [cite: 46]
            ["nombre" => "CÉRTEGUI - Chocó", "codigo" => "27160"], // [cite: 46]
            ["nombre" => "CONDOTO - Chocó", "codigo" => "27205"], // [cite: 46]
            ["nombre" => "EL CARMEN DE ATRATO - Chocó", "codigo" => "27245"], // [cite: 46]
            ["nombre" => "EL LITORAL DEL SAN JUAN - Chocó", "codigo" => "27250"], // [cite: 46]
            ["nombre" => "ISTMINA - Chocó", "codigo" => "27361"], // [cite: 46]
            ["nombre" => "JURADÓ - Chocó", "codigo" => "27372"], // [cite: 46]
            ["nombre" => "LLORÓ - Chocó", "codigo" => "27413"], // [cite: 46]
            ["nombre" => "MEDIO ATRATO - Chocó", "codigo" => "27425"], // [cite: 46]
            ["nombre" => "MEDIO BAUDÓ - Chocó", "codigo" => "27430"], // [cite: 46]
            ["nombre" => "MEDIO SAN JUAN - Chocó", "codigo" => "27450"], // [cite: 46]
            ["nombre" => "NÓVITA - Chocó", "codigo" => "27491"], // [cite: 46]
            ["nombre" => "NUQUÍ - Chocó", "codigo" => "27495"], // [cite: 46]
            ["nombre" => "RÍO IRO - Chocó", "codigo" => "27580"], // [cite: 46]
            ["nombre" => "RÍO QUITO - Chocó", "codigo" => "27600"], // [cite: 46]
            ["nombre" => "RIOSUCIO - Chocó", "codigo" => "27615"], // [cite: 48]
            ["nombre" => "SAN JOSÉ DEL PALMAR - Chocó", "codigo" => "27660"], // [cite: 48]
            ["nombre" => "SIPÍ - Chocó", "codigo" => "27745"], // [cite: 48]
            ["nombre" => "TADÓ - Chocó", "codigo" => "27787"], // [cite: 48]
            ["nombre" => "UNGUÍA - Chocó", "codigo" => "27800"], // [cite: 48]
            ["nombre" => "UNÓN PANAMERICANA - Chocó", "codigo" => "27810"], // [cite: 48]

            // --- HUILA ---
            ["nombre" => "NEIVA - Huila", "codigo" => "41001"], // [cite: 48]
            ["nombre" => "ACEVEDO - Huila", "codigo" => "41006"], // [cite: 48]
            ["nombre" => "AGRADO - Huila", "codigo" => "41013"], // [cite: 48]
            ["nombre" => "AIPE - Huila", "codigo" => "41016"], // [cite: 48]
            ["nombre" => "ALGECIRAS - Huila", "codigo" => "41020"], // [cite: 48]
            ["nombre" => "ALTAMIRA - Huila", "codigo" => "41026"], // [cite: 48]
            ["nombre" => "BARAYA - Huila", "codigo" => "41078"], // [cite: 48]
            ["nombre" => "CAMPOALEGRE - Huila", "codigo" => "41132"], // [cite: 48]
            ["nombre" => "COLOMBIA - Huila", "codigo" => "41206"], // [cite: 48]
            ["nombre" => "ELÍAS - Huila", "codigo" => "41244"], // [cite: 48]
            ["nombre" => "GARZÓN - Huila", "codigo" => "41298"], // [cite: 48]
            ["nombre" => "GIGANTE - Huila", "codigo" => "41306"], // [cite: 48]
            ["nombre" => "GUADALUPE - Huila", "codigo" => "41319"], // [cite: 48]
            ["nombre" => "HOBO - Huila", "codigo" => "41349"], // [cite: 48]
            ["nombre" => "IQUIRA - Huila", "codigo" => "41357"], // [cite: 48]
            ["nombre" => "ISNOS - Huila", "codigo" => "41359"], // [cite: 48]
            ["nombre" => "LA ARGENTINA - Huila", "codigo" => "41378"], // [cite: 48]
            ["nombre" => "LA PLATA - Huila", "codigo" => "41396"], // [cite: 48]
            ["nombre" => "NÁTAGA - Huila", "codigo" => "41483"], // [cite: 48]
            ["nombre" => "OPORAPA - Huila", "codigo" => "41503"], // [cite: 48]
            ["nombre" => "PAICOL - Huila", "codigo" => "41518"], // [cite: 48]
            ["nombre" => "PALERMO - Huila", "codigo" => "41524"], // [cite: 48]
            ["nombre" => "PALESTINA - Huila", "codigo" => "41530"], // [cite: 48]
            ["nombre" => "PITAL - Huila", "codigo" => "41548"], // [cite: 48]
            ["nombre" => "PITALITO - Huila", "codigo" => "41551"], // [cite: 48]
            ["nombre" => "RIVERA - Huila", "codigo" => "41615"], // [cite: 48]
            ["nombre" => "SALADOBLANCO - Huila", "codigo" => "41660"], // [cite: 48]
            ["nombre" => "SAN AGUSTÍN - Huila", "codigo" => "41668"], // [cite: 48]
            ["nombre" => "SANTA MARÍA - Huila", "codigo" => "41676"], // [cite: 48]
            ["nombre" => "SUAZA - Huila", "codigo" => "41770"], // [cite: 48]
            ["nombre" => "TARQUI - Huila", "codigo" => "41791"], // [cite: 48]
            ["nombre" => "TESALIA - Huila", "codigo" => "41797"], // [cite: 48]
            ["nombre" => "TELLO - Huila", "codigo" => "41799"], // [cite: 48]
            ["nombre" => "TERUEL - Huila", "codigo" => "41801"], // [cite: 48]
            ["nombre" => "TIMANÁ - Huila", "codigo" => "41807"], // [cite: 49]
            ["nombre" => "VILLAVIEJA - Huila", "codigo" => "41872"], // [cite: 49]
            ["nombre" => "YAGUARÁ - Huila", "codigo" => "41885"], // [cite: 49]

            // --- LA GUAJIRA ---
            ["nombre" => "RIOHACHA - La Guajira", "codigo" => "44001"], // [cite: 49]
            ["nombre" => "ALBANIA - La Guajira", "codigo" => "44035"], // [cite: 49]
            ["nombre" => "BARRANCAS - La Guajira", "codigo" => "44078"], // [cite: 49]
            ["nombre" => "DIBULLA - La Guajira", "codigo" => "44090"], // [cite: 49]
            ["nombre" => "DISTRACCIÓN - La Guajira", "codigo" => "44098"], // [cite: 49]
            ["nombre" => "EL MOLINO - La Guajira", "codigo" => "44110"], // [cite: 49]
            ["nombre" => "FONSECA - La Guajira", "codigo" => "44279"], // [cite: 49]
            ["nombre" => "HATONUEVO - La Guajira", "codigo" => "44378"], // [cite: 49]
            ["nombre" => "LA JAGUA DEL PILAR - La Guajira", "codigo" => "44420"], // [cite: 49]
            ["nombre" => "MAICAO - La Guajira", "codigo" => "44430"], // [cite: 49]
            ["nombre" => "MANAURE - La Guajira", "codigo" => "44560"], // [cite: 49]
            ["nombre" => "SAN JUAN DEL CESAR - La Guajira", "codigo" => "44650"], // [cite: 49]
            ["nombre" => "URIBIA - La Guajira", "codigo" => "44847"], // [cite: 49]
            ["nombre" => "URUMITA - La Guajira", "codigo" => "44855"], // [cite: 49]
            ["nombre" => "VILLANUEVA - La Guajira", "codigo" => "44874"], // [cite: 49]

            // --- MAGDALENA ---
            ["nombre" => "SANTA MARTA - Magdalena", "codigo" => "47001"], // [cite: 49]
            ["nombre" => "ALGARROBO - Magdalena", "codigo" => "47030"], // [cite: 49]
            ["nombre" => "ARACATACA - Magdalena", "codigo" => "47053"], // [cite: 49]
            ["nombre" => "ARIGUANÍ - Magdalena", "codigo" => "47058"], // [cite: 49]
            ["nombre" => "CERRO SAN ANTONIO - Magdalena", "codigo" => "47161"], // [cite: 49]
            ["nombre" => "CHIBOLO - Magdalena", "codigo" => "47170"], // [cite: 49]
            ["nombre" => "CIÉNAGA - Magdalena", "codigo" => "47189"], // [cite: 49]
            ["nombre" => "CONCORDIA - Magdalena", "codigo" => "47205"], // [cite: 49]
            ["nombre" => "EL BANCO - Magdalena", "codigo" => "47245"], // [cite: 49]
            ["nombre" => "EL PIÑON - Magdalena", "codigo" => "47258"], // [cite: 49]
            ["nombre" => "EL RETÉN - Magdalena", "codigo" => "47268"], // [cite: 49]
            ["nombre" => "FUNDACIÓN - Magdalena", "codigo" => "47288"], // [cite: 49]
            ["nombre" => "GUAMAL - Magdalena", "codigo" => "47318"], // [cite: 49]
            ["nombre" => "NUEVA GRANADA - Magdalena", "codigo" => "47460"], // [cite: 49]
            ["nombre" => "PEDRAZA - Magdalena", "codigo" => "47541"], // [cite: 49]
            ["nombre" => "PIJIÑO DEL CARMEN - Magdalena", "codigo" => "47545"], // [cite: 49]
            ["nombre" => "PIVIJAY - Magdalena", "codigo" => "47551"], // [cite: 49]
            ["nombre" => "PLATO - Magdalena", "codigo" => "47555"], // [cite: 49]
            ["nombre" => "PUEBLOVIEJO - Magdalena", "codigo" => "47570"], // [cite: 49]
            ["nombre" => "REMOLINO - Magdalena", "codigo" => "47605"], // [cite: 49]
            ["nombre" => "SABANAS DE SAN ANGEL - Magdalena", "codigo" => "47660"], // [cite: 49]
            ["nombre" => "SALAMINA - Magdalena", "codigo" => "47675"], // [cite: 50]
            ["nombre" => "SAN SEBASTIÁN DE BUENAVISTA - Magdalena", "codigo" => "47692"], // [cite: 51]
            ["nombre" => "SAN ZENÓN - Magdalena", "codigo" => "47703"], // [cite: 51]
            ["nombre" => "SANTA ANA - Magdalena", "codigo" => "47707"], // [cite: 51]
            ["nombre" => "SANTA BÁRBARA DE PINTO - Magdalena", "codigo" => "47720"], // [cite: 51]
            ["nombre" => "SITIONUEVO - Magdalena", "codigo" => "47745"], // [cite: 51]
            ["nombre" => "TENERIFE - Magdalena", "codigo" => "47980"], // [cite: 51]
            ["nombre" => "ZAPAYÁN - Magdalena", "codigo" => "47960"], // [cite: 51]
            ["nombre" => "ZONA BANANERA - Magdalena", "codigo" => "47980"], // [cite: 51]

            // --- META ---
            ["nombre" => "VILLAVICENCIO - Meta", "codigo" => "50001"], // [cite: 51]
            ["nombre" => "ACACÍAS - Meta", "codigo" => "50006"], // [cite: 51]
            ["nombre" => "BARRANCA DE UPÍA - Meta", "codigo" => "50110"], // [cite: 51]
            ["nombre" => "CABUYARO - Meta", "codigo" => "50124"], // [cite: 51]
            ["nombre" => "CASTILLA LA NUEVA - Meta", "codigo" => "50150"], // [cite: 51]
            ["nombre" => "CUBARRAL - Meta", "codigo" => "50223"], // [cite: 51]
            ["nombre" => "CUMARAL - Meta", "codigo" => "50226"], // [cite: 51]
            ["nombre" => "EL CALVARIO - Meta", "codigo" => "50245"], // [cite: 51]
            ["nombre" => "EL CASTILLO - Meta", "codigo" => "50251"], // [cite: 51]
            ["nombre" => "EL DORADO - Meta", "codigo" => "50270"], // [cite: 51]
            ["nombre" => "FUENTE DE ORO - Meta", "codigo" => "50287"], // [cite: 51]
            ["nombre" => "GRANADA - Meta", "codigo" => "50313"], // [cite: 51]
            ["nombre" => "GUAMAL - Meta", "codigo" => "50318"], // [cite: 51]
            ["nombre" => "MAPIRIPÁN - Meta", "codigo" => "50325"], // [cite: 51]
            ["nombre" => "MESETAS - Meta", "codigo" => "50330"], // [cite: 51]
            ["nombre" => "LA MACARENA - Meta", "codigo" => "50350"], // [cite: 51]
            ["nombre" => "URIBE - Meta", "codigo" => "50370"], // [cite: 51]
            ["nombre" => "LEJANÍAS - Meta", "codigo" => "50400"], // [cite: 51]
            ["nombre" => "PUERTO CONCORDIA - Meta", "codigo" => "50450"], // [cite: 51]
            ["nombre" => "PUERTO GAITÁN - Meta", "codigo" => "50568"], // [cite: 51]
            ["nombre" => "PUERTO LÓPEZ - Meta", "codigo" => "50573"], // [cite: 51]
            ["nombre" => "PUERTO LLERAS - Meta", "codigo" => "50577"], // [cite: 51]
            ["nombre" => "PUERTO RICO - Meta", "codigo" => "50590"], // [cite: 51]
            ["nombre" => "RESTREPO - Meta", "codigo" => "50606"], // [cite: 51]
            ["nombre" => "SAN CARLOS DE GUAROA - Meta", "codigo" => "50680"], // [cite: 51]
            ["nombre" => "SAN JUAN DE ARAMA - Meta", "codigo" => "50683"], // [cite: 51, 52]
            ["nombre" => "SAN JUANITO - Meta", "codigo" => "50686"], // [cite: 52]
            ["nombre" => "SAN MARTÍN - Meta", "codigo" => "50689"], // [cite: 52]
            ["nombre" => "VISTAHERMOSA - Meta", "codigo" => "50711"], // [cite: 52]

            // --- NARIÑO ---
            ["nombre" => "PASTO - Nariño", "codigo" => "52001"], // [cite: 52]
            ["nombre" => "ALBÁN - Nariño", "codigo" => "52019"], // [cite: 52]
            ["nombre" => "ALDANA - Nariño", "codigo" => "52022"], // [cite: 52]
            ["nombre" => "ANCUYÁ - Nariño", "codigo" => "52036"], // [cite: 53]
            ["nombre" => "ARBOLEDA - Nariño", "codigo" => "52051"], // [cite: 53]
            ["nombre" => "BARBACOAS - Nariño", "codigo" => "52079"], // [cite: 53]
            ["nombre" => "BELÉN - Nariño", "codigo" => "52083"], // [cite: 53]
            ["nombre" => "BUESACO - Nariño", "codigo" => "52110"], // [cite: 53]
            ["nombre" => "COLÓN - Nariño", "codigo" => "52203"], // [cite: 53]
            ["nombre" => "CONSACA - Nariño", "codigo" => "52207"], // [cite: 53]
            ["nombre" => "CONTADERO - Nariño", "codigo" => "52210"], // [cite: 53]
            ["nombre" => "CÓRDOBA - Nariño", "codigo" => "52215"], // [cite: 53]
            ["nombre" => "CUASPUD - Nariño", "codigo" => "52224"], // [cite: 53]
            ["nombre" => "CUMBAL - Nariño", "codigo" => "52227"], // [cite: 53]
            ["nombre" => "CUMBITARA - Nariño", "codigo" => "52233"], // [cite: 53]
            ["nombre" => "CHACHAGÜÍ - Nariño", "codigo" => "52240"], // [cite: 53]
            ["nombre" => "EL CHARCO - Nariño", "codigo" => "52250"], // [cite: 53]
            ["nombre" => "EL PEÑOL - Nariño", "codigo" => "52254"], // [cite: 53]
            ["nombre" => "EL ROSARIO - Nariño", "codigo" => "52256"], // [cite: 53]
            ["nombre" => "EL TABLÓN DE GÓMEZ - Nariño", "codigo" => "52258"], // [cite: 53]
            ["nombre" => "EL TAMBO - Nariño", "codigo" => "52260"], // [cite: 53]
            ["nombre" => "FUNES - Nariño", "codigo" => "52287"], // [cite: 53]
            ["nombre" => "GUACHUCAL - Nariño", "codigo" => "52317"], // [cite: 53]
            ["nombre" => "GUAITARILLA - Nariño", "codigo" => "52320"], // [cite: 53]
            ["nombre" => "GUALMATÁN - Nariño", "codigo" => "52323"], // [cite: 53]
            ["nombre" => "ILES - Nariño", "codigo" => "52352"], // [cite: 53]
            ["nombre" => "IMUÉS - Nariño", "codigo" => "52354"], // [cite: 53]
            ["nombre" => "IPIALES - Nariño", "codigo" => "52356"], // [cite: 53]
            ["nombre" => "LA CRUZ - Nariño", "codigo" => "52378"], // [cite: 53]
            ["nombre" => "LA FLORIDA - Nariño", "codigo" => "52381"], // [cite: 53]
            ["nombre" => "LA LLANADA - Nariño", "codigo" => "52385"], // [cite: 53]
            ["nombre" => "LA TOLA - Nariño", "codigo" => "52390"], // [cite: 53]
            ["nombre" => "LA UNIÓN - Nariño", "codigo" => "52399"], // [cite: 53]
            ["nombre" => "LEIVA - Nariño", "codigo" => "52405"], // [cite: 53]
            ["nombre" => "LINARES - Nariño", "codigo" => "52411"], // [cite: 53]
            ["nombre" => "LOS ANDES - Nariño", "codigo" => "52418"], // [cite: 53]
            ["nombre" => "MAGÜI - Nariño", "codigo" => "52427"], // [cite: 53]
            ["nombre" => "MALLAMA - Nariño", "codigo" => "52435"], // [cite: 53]
            ["nombre" => "MOSQUERA - Nariño", "codigo" => "52473"], // [cite: 53]
            ["nombre" => "NARIÑO - Nariño", "codigo" => "52480"], // [cite: 53]
            ["nombre" => "OLAYA HERRERA - Nariño", "codigo" => "52490"], // [cite: 53]
            ["nombre" => "OSPINA - Nariño", "codigo" => "52506"], // [cite: 53]
            ["nombre" => "FRANCISCO PIZARRO - Nariño", "codigo" => "52520"], // [cite: 53]
            ["nombre" => "POLICARPA - Nariño", "codigo" => "52540"], // [cite: 54]
            ["nombre" => "POTOSÍ - Nariño", "codigo" => "52560"], // [cite: 54]
            ["nombre" => "PROVIDENCIA - Nariño", "codigo" => "52565"], // [cite: 54]
            ["nombre" => "PUERRES - Nariño", "codigo" => "52573"], // [cite: 54]
            ["nombre" => "PUPIALES - Nariño", "codigo" => "52585"], // [cite: 54]
            ["nombre" => "RICAURTE - Nariño", "codigo" => "52612"], // [cite: 54]
            ["nombre" => "ROBERTO PAYÁN - Nariño", "codigo" => "52621"], // [cite: 54]
            ["nombre" => "SAMANIEGO - Nariño", "codigo" => "52678"], // [cite: 54]
            ["nombre" => "SANDONÁ - Nariño", "codigo" => "52683"], // [cite: 54]
            ["nombre" => "SAN BERNARDO - Nariño", "codigo" => "52685"], // [cite: 54]
            ["nombre" => "SAN LORENZO - Nariño", "codigo" => "52687"], // [cite: 54]
            ["nombre" => "SAN PABLO - Nariño", "codigo" => "52693"], // [cite: 54]
            ["nombre" => "SAN PEDRO DE CARTAGO - Nariño", "codigo" => "52694"], // [cite: 54]
            ["nombre" => "SANTA BÁRBARA - Nariño", "codigo" => "52696"], // [cite: 54]
            ["nombre" => "SANTACRUZ - Nariño", "codigo" => "52699"], // [cite: 54]
            ["nombre" => "SAPUYES - Nariño", "codigo" => "52720"], // [cite: 54]
            ["nombre" => "TAMINANGO - Nariño", "codigo" => "52786"], // [cite: 54]
            ["nombre" => "TANGUA - Nariño", "codigo" => "52788"], // [cite: 54]
            ["nombre" => "SAN ANDRES DE TUMACO - Nariño", "codigo" => "52835"], // [cite: 54]
            ["nombre" => "TÚQUERRES - Nariño", "codigo" => "52838"], // [cite: 54]
            ["nombre" => "YACUANQUER - Nariño", "codigo" => "52885"], // [cite: 54]

            // --- NORTE DE SANTANDER ---
            ["nombre" => "CÚCUTA - Norte de Santander", "codigo" => "54001"], // [cite: 54]
            ["nombre" => "ABREGO - Norte de Santander", "codigo" => "54003"], // [cite: 54]
            ["nombre" => "ARBOLEDAS - Norte de Santander", "codigo" => "54051"], // [cite: 54]
            ["nombre" => "BOCHALEMA - Norte de Santander", "codigo" => "54099"], // [cite: 54]
            ["nombre" => "BUCARASICA - Norte de Santander", "codigo" => "54109"], // [cite: 54]
            ["nombre" => "CÁCOTA - Norte de Santander", "codigo" => "54125"], // [cite: 54]
            ["nombre" => "CACHIRÁ - Norte de Santander", "codigo" => "54128"], // [cite: 54]
            ["nombre" => "CHINÁCOTA - Norte de Santander", "codigo" => "54172"], // [cite: 54]
            ["nombre" => "CHITAGÁ - Norte de Santander", "codigo" => "54174"], // [cite: 54]
            ["nombre" => "CONVENCIÓN - Norte de Santander", "codigo" => "54206"], // [cite: 54]
            ["nombre" => "CUCUTILLA - Norte de Santander", "codigo" => "54223"], // [cite: 54]
            ["nombre" => "DURANIA - Norte de Santander", "codigo" => "54239"], // [cite: 54]
            ["nombre" => "EL CARMEN - Norte de Santander", "codigo" => "54245"], // [cite: 54]
            ["nombre" => "EL TARRA - Norte de Santander", "codigo" => "54250"], // [cite: 54]
            ["nombre" => "EL ZULIA - Norte de Santander", "codigo" => "54261"], // [cite: 54]
            ["nombre" => "GRAMALOTE - Norte de Santander", "codigo" => "54313"], // [cite: 54]
            ["nombre" => "HACARÍ - Norte de Santander", "codigo" => "54344"], // [cite: 54]
            ["nombre" => "HERRÁN - Norte de Santander", "codigo" => "54347"], // [cite: 54]
            ["nombre" => "LABATECA - Norte de Santander", "codigo" => "54377"], // [cite: 54]
            ["nombre" => "LA ESPERANZA - Norte de Santander", "codigo" => "54385"], // [cite: 55]
            ["nombre" => "LA PLAYA - Norte de Santander", "codigo" => "54398"], // [cite: 55]
            ["nombre" => "LOS PATIOS - Norte de Santander", "codigo" => "54405"], // [cite: 55]
            ["nombre" => "LOURDES - Norte de Santander", "codigo" => "54418"], // [cite: 55]
            ["nombre" => "MUTISCUA - Norte de Santander", "codigo" => "54480"], // [cite: 55]
            ["nombre" => "OCAÑA - Norte de Santander", "codigo" => "54498"], // [cite: 55]
            ["nombre" => "PAMPLONA - Norte de Santander", "codigo" => "54518"], // [cite: 55]
            ["nombre" => "PAMPLONITA - Norte de Santander", "codigo" => "54520"], // [cite: 55]
            ["nombre" => "PUERTO SANTANDER - Norte de Santander", "codigo" => "54553"], // [cite: 55]
            ["nombre" => "RAGONVALIA - Norte de Santander", "codigo" => "54599"], // [cite: 55]
            ["nombre" => "SALAZAR - Norte de Santander", "codigo" => "54660"], // [cite: 55]
            ["nombre" => "SAN CALIXTO - Norte de Santander", "codigo" => "54670"], // [cite: 55]
            ["nombre" => "SAN CAYETANO - Norte de Santander", "codigo" => "54673"], // [cite: 55]
            ["nombre" => "SANTIAGO - Norte de Santander", "codigo" => "54680"], // [cite: 55]
            ["nombre" => "SARDINATA - Norte de Santander", "codigo" => "54720"], // [cite: 55]
            ["nombre" => "SILOS - Norte de Santander", "codigo" => "54743"], // [cite: 55]
            ["nombre" => "TEORAMA - Norte de Santander", "codigo" => "54800"], // [cite: 55]
            ["nombre" => "TIBÚ - Norte de Santander", "codigo" => "54810"], // [cite: 55]
            ["nombre" => "TOLEDO - Norte de Santander", "codigo" => "54820"], // [cite: 55]
            ["nombre" => "VILLA CARO - Norte de Santander", "codigo" => "54871"], // [cite: 55]
            ["nombre" => "VILLA DEL ROSARIO - Norte de Santander", "codigo" => "54874"], // [cite: 55]

            // --- QUINDÍO ---
            ["nombre" => "ARMENIA - Quindío", "codigo" => "63001"], // [cite: 55]
            ["nombre" => "BUENAVISTA - Quindío", "codigo" => "63111"], // [cite: 55]
            ["nombre" => "CALARCA - Quindío", "codigo" => "63130"], // [cite: 55]
            ["nombre" => "CIRCASIA - Quindío", "codigo" => "63190"], // [cite: 55]
            ["nombre" => "CÓRDOBA - Quindío", "codigo" => "63212"], // [cite: 55]
            ["nombre" => "FILANDIA - Quindío", "codigo" => "63272"], // [cite: 55]
            ["nombre" => "GÉNOVA - Quindío", "codigo" => "63302"], // [cite: 55]
            ["nombre" => "LA TEBAIDA - Quindío", "codigo" => "63401"], // [cite: 55]
            ["nombre" => "MONTENEGRO - Quindío", "codigo" => "63470"], // [cite: 55]
            ["nombre" => "PIJAO - Quindío", "codigo" => "63548"], // [cite: 55]
            ["nombre" => "QUIMBAYA - Quindío", "codigo" => "63594"], // [cite: 55]
            ["nombre" => "SALENTO - Quindío", "codigo" => "63690"], // [cite: 55]

            // --- RISARALDA ---
            ["nombre" => "PEREIRA - Risaralda", "codigo" => "66001"], // [cite: 55]
            ["nombre" => "APÍA - Risaralda", "codigo" => "66045"], // [cite: 55]
            ["nombre" => "BALBOA - Risaralda", "codigo" => "66075"], // [cite: 55]
            ["nombre" => "BELÉN DE UMBRÍA - Risaralda", "codigo" => "66088"], // [cite: 55]
            ["nombre" => "DOSQUEBRADAS - Risaralda", "codigo" => "66170"], // [cite: 55]
            ["nombre" => "GUÁTICA - Risaralda", "codigo" => "66318"], // [cite: 55]
            ["nombre" => "LA CELIA - Risaralda", "codigo" => "66383"], // [cite: 55]
            ["nombre" => "LA VIRGINIA - Risaralda", "codigo" => "66400"], // [cite: 56]
            ["nombre" => "MARSELLA - Risaralda", "codigo" => "66440"], // [cite: 56]
            ["nombre" => "MISTRATÓ - Risaralda", "codigo" => "66456"], // [cite: 56]
            ["nombre" => "PUEBLO RICO - Risaralda", "codigo" => "66572"], // [cite: 56]
            ["nombre" => "QUINCHÍA - Risaralda", "codigo" => "66594"], // [cite: 56]
            ["nombre" => "SANTA ROSA DE CABAL - Risaralda", "codigo" => "66682"], // [cite: 56]
            ["nombre" => "SANTUARIO - Risaralda", "codigo" => "66687"], // [cite: 56]

            // --- SANTANDER ---
            ["nombre" => "BUCARAMANGA - Santander", "codigo" => "68001"], // [cite: 56]
            ["nombre" => "AGUADA - Santander", "codigo" => "68013"], // [cite: 56]
            ["nombre" => "ALBANIA - Santander", "codigo" => "68020"], // [cite: 56]
            ["nombre" => "ARATOCA - Santander", "codigo" => "68051"], // [cite: 56]
            ["nombre" => "BARBOSA - Santander", "codigo" => "68077"], // [cite: 56]
            ["nombre" => "BARICHARA - Santander", "codigo" => "68079"], // [cite: 56]
            ["nombre" => "BARRANCABERMEJA - Santander", "codigo" => "68081"], // [cite: 56]
            ["nombre" => "BETULIA - Santander", "codigo" => "68092"], // [cite: 56]
            ["nombre" => "BOLÍVAR - Santander", "codigo" => "68101"], // [cite: 56]
            ["nombre" => "CABRERA - Santander", "codigo" => "68121"], // [cite: 56]
            ["nombre" => "CALIFORNIA - Santander", "codigo" => "68132"], // [cite: 56]
            ["nombre" => "CAPITANEJO - Santander", "codigo" => "68147"], // [cite: 56]
            ["nombre" => "CARCASÍ - Santander", "codigo" => "68152"], // [cite: 56]
            ["nombre" => "CEPITÁ - Santander", "codigo" => "68160"], // [cite: 56]
            ["nombre" => "CERRITO - Santander", "codigo" => "68162"], // [cite: 56]
            ["nombre" => "CHARALÁ - Santander", "codigo" => "68167"], // [cite: 56]
            ["nombre" => "CHARTA - Santander", "codigo" => "68169"], // [cite: 56]
            ["nombre" => "CHIMA - Santander", "codigo" => "68176"], // [cite: 56]
            ["nombre" => "CHIPATÁ - Santander", "codigo" => "68179"], // [cite: 56]
            ["nombre" => "CIMITARRA - Santander", "codigo" => "68190"], // [cite: 56]
            ["nombre" => "CONCEPCIÓN - Santander", "codigo" => "68207"], // [cite: 56]
            ["nombre" => "CONFINES - Santander", "codigo" => "68209"], // [cite: 56]
            ["nombre" => "CONTRATACIÓN - Santander", "codigo" => "68211"], // [cite: 56]
            ["nombre" => "COROMORO - Santander", "codigo" => "68217"], // [cite: 56]
            ["nombre" => "CURITÍ - Santander", "codigo" => "68229"], // [cite: 56]
            ["nombre" => "EL CARMEN DE CHUCURÍ - Santander", "codigo" => "68235"], // [cite: 56]
            ["nombre" => "EL GUACAMAYO - Santander", "codigo" => "68245"], // [cite: 56]
            ["nombre" => "EL PEÑÓN - Santander", "codigo" => "68250"], // [cite: 56]
            ["nombre" => "EL PLAYÓN - Santander", "codigo" => "68255"], // [cite: 56]
            ["nombre" => "ENCINO - Santander", "codigo" => "68264"], // [cite: 56]
            ["nombre" => "ENCISO - Santander", "codigo" => "68266"], // [cite: 56]
            ["nombre" => "FLORIÁN - Santander", "codigo" => "68271"], // [cite: 56]
            ["nombre" => "FLORIDABLANCA - Santander", "codigo" => "68276"], // [cite: 56]
            ["nombre" => "GALÁN - Santander", "codigo" => "68296"], // [cite: 57]
            ["nombre" => "GAMBITA - Santander", "codigo" => "68298"], // [cite: 57]
            ["nombre" => "GIRÓN - Santander", "codigo" => "68307"], // [cite: 57]
            ["nombre" => "GUACA - Santander", "codigo" => "68318"], // [cite: 57]
            ["nombre" => "GUADALUPE - Santander", "codigo" => "68320"], // [cite: 57]
            ["nombre" => "GUAPOTÁ - Santander", "codigo" => "68322"], // [cite: 57]
            ["nombre" => "GUAVATÁ - Santander", "codigo" => "68324"], // [cite: 57]
            ["nombre" => "GÜEPSA - Santander", "codigo" => "68327"], // [cite: 57]
            ["nombre" => "HATO - Santander", "codigo" => "68344"], // [cite: 57]
            ["nombre" => "JESÚS MARÍA - Santander", "codigo" => "68368"], // [cite: 57]
            ["nombre" => "JORDÁN - Santander", "codigo" => "68370"], // [cite: 57]
            ["nombre" => "LA BELLEZA - Santander", "codigo" => "68377"], // [cite: 57]
            ["nombre" => "LANDÁZURI - Santander", "codigo" => "68385"], // [cite: 57]
            ["nombre" => "LA PAZ - Santander", "codigo" => "68406"], // [cite: 57]
            ["nombre" => "LEBRÍJA - Santander", "codigo" => "68406"], // [cite: 57]
            ["nombre" => "LOS SANTOS - Santander", "codigo" => "68418"], // [cite: 57]
            ["nombre" => "MACARAVITA - Santander", "codigo" => "68425"], // [cite: 57]
            ["nombre" => "MÁLAGA - Santander", "codigo" => "68432"], // [cite: 57]
            ["nombre" => "MATANZA - Santander", "codigo" => "68444"], // [cite: 57]
            ["nombre" => "MOGOTES - Santander", "codigo" => "68464"], // [cite: 57]
            ["nombre" => "MOLAGAVITA - Santander", "codigo" => "68468"], // [cite: 57]
            ["nombre" => "OCAMONTE - Santander", "codigo" => "68498"], // [cite: 57]
            ["nombre" => "OIBA - Santander", "codigo" => "68500"], // [cite: 57]
            ["nombre" => "ONZAGA - Santander", "codigo" => "68502"], // [cite: 57]
            ["nombre" => "PALMAR - Santander", "codigo" => "68522"], // [cite: 57]
            ["nombre" => "PALMAS DEL SOCORRO - Santander", "codigo" => "68524"], // [cite: 57]
            ["nombre" => "PÁRAMO - Santander", "codigo" => "68533"], // [cite: 57]
            ["nombre" => "PIEDECUESTA - Santander", "codigo" => "68547"], // [cite: 57]
            ["nombre" => "PINCHOTE - Santander", "codigo" => "68549"], // [cite: 57]
            ["nombre" => "PUENTE NACIONAL - Santander", "codigo" => "68572"], // [cite: 57]
            ["nombre" => "PUERTO PARRA - Santander", "codigo" => "68573"], // [cite: 57]
            ["nombre" => "PUERTO WILCHES - Santander", "codigo" => "68575"], // [cite: 57]
            ["nombre" => "RIONEGRO - Santander", "codigo" => "68615"], // [cite: 57]
            ["nombre" => "SABANA DE TORRES - Santander", "codigo" => "68655"], // [cite: 57]
            ["nombre" => "SAN ANDRÉS - Santander", "codigo" => "68669"], // [cite: 57]
            ["nombre" => "SAN BENITO - Santander", "codigo" => "68673"], // [cite: 57]
            ["nombre" => "SAN GIL - Santander", "codigo" => "68679"], // [cite: 57]
            ["nombre" => "SAN JOAQUÍN - Santander", "codigo" => "68682"], // [cite: 57]
            ["nombre" => "SAN JOSÉ DE MIRANDA - Santander", "codigo" => "68684"], // [cite: 57]
            ["nombre" => "SAN MIGUEL - Santander", "codigo" => "68686"], // [cite: 57, 58]
            ["nombre" => "SAN VICENTE DE CHUCURÍ - Santander", "codigo" => "68689"], // [cite: 59]
            ["nombre" => "SANTA BÁRBARA - Santander", "codigo" => "68705"], // [cite: 59]
            ["nombre" => "SANTA HELENA DEL OPÓN - Santander", "codigo" => "68720"], // [cite: 59]
            ["nombre" => "SIMACOTA - Santander", "codigo" => "68745"], // [cite: 59]
            ["nombre" => "SOCORRO - Santander", "codigo" => "68755"], // [cite: 59]
            ["nombre" => "SUAITA - Santander", "codigo" => "68770"], // [cite: 59]
            ["nombre" => "SUCRE - Santander", "codigo" => "68773"], // [cite: 59]
            ["nombre" => "SURATÁ - Santander", "codigo" => "68780"], // [cite: 59]
            ["nombre" => "TONA - Santander", "codigo" => "68820"], // [cite: 59]
            ["nombre" => "VALLE DE SAN JOSÉ - Santander", "codigo" => "68855"], // [cite: 59]
            ["nombre" => "VÉLEZ - Santander", "codigo" => "68861"], // [cite: 59]
            ["nombre" => "VETAS - Santander", "codigo" => "68867"], // [cite: 59]
            ["nombre" => "VILLANUEVA - Santander", "codigo" => "68872"], // [cite: 59]
            ["nombre" => "ZAPATOCA - Santander", "codigo" => "68895"], // [cite: 59]

            // --- SUCRE ---
            ["nombre" => "SINCELEJO - Sucre", "codigo" => "70001"], // [cite: 59]
            ["nombre" => "BUENAVISTA - Sucre", "codigo" => "70110"], // [cite: 59]
            ["nombre" => "CAIMITO - Sucre", "codigo" => "70124"], // [cite: 59]
            ["nombre" => "COLOSO - Sucre", "codigo" => "70204"], // [cite: 59]
            ["nombre" => "COROZAL - Sucre", "codigo" => "70215"], // [cite: 59]
            ["nombre" => "COVEÑAS - Sucre", "codigo" => "70221"], // [cite: 59]
            ["nombre" => "CHALÁN - Sucre", "codigo" => "70230"], // [cite: 59]
            ["nombre" => "EL ROBLE - Sucre", "codigo" => "70233"], // [cite: 59]
            ["nombre" => "GALERAS - Sucre", "codigo" => "70235"], // [cite: 59]
            ["nombre" => "GUARANDA - Sucre", "codigo" => "70265"], // [cite: 59]
            ["nombre" => "LA UNIÓN - Sucre", "codigo" => "70400"], // [cite: 59]
            ["nombre" => "LOS PALMITOS - Sucre", "codigo" => "70418"], // [cite: 59]
            ["nombre" => "MAJAGUAL - Sucre", "codigo" => "70429"], // [cite: 59]
            ["nombre" => "MORROA - Sucre", "codigo" => "70473"], // [cite: 59]
            ["nombre" => "OVEJAS - Sucre", "codigo" => "70508"], // [cite: 59]
            ["nombre" => "PALMITO - Sucre", "codigo" => "70523"], // [cite: 59]
            ["nombre" => "SAMPUÉS - Sucre", "codigo" => "70670"], // [cite: 59]
            ["nombre" => "SAN BENITO ABAD - Sucre", "codigo" => "70678"], // [cite: 59]
            ["nombre" => "SAN JUAN DE BETULIA - Sucre", "codigo" => "70702"], // [cite: 59]
            ["nombre" => "SAN MARCOS - Sucre", "codigo" => "70708"], // [cite: 59]
            ["nombre" => "SAN ONOFRE - Sucre", "codigo" => "70713"], // [cite: 59]
            ["nombre" => "SAN PEDRO - Sucre", "codigo" => "70717"], // [cite: 59]
            ["nombre" => "SAN LUIS DE SINCÉ - Sucre", "codigo" => "70742"], // [cite: 59, 60]
            ["nombre" => "SUCRE - Sucre", "codigo" => "70771"], // [cite: 60]
            ["nombre" => "SANTIAGO DE TOLÚ - Sucre", "codigo" => "70820"], // [cite: 60]
            ["nombre" => "TOLÚ VIEJO - Sucre", "codigo" => "70823"], // [cite: 60]

            // --- TOLIMA ---
            ["nombre" => "IBAGUÉ - Tolima", "codigo" => "73001"], // [cite: 61]
            ["nombre" => "ALPUJARRA - Tolima", "codigo" => "73024"], // [cite: 61]
            ["nombre" => "ALVARADO - Tolima", "codigo" => "73026"], // [cite: 61]
            ["nombre" => "AMBALEMA - Tolima", "codigo" => "73030"], // [cite: 61]
            ["nombre" => "ANZOÁTEGUI - Tolima", "codigo" => "73043"], // [cite: 61]
            ["nombre" => "ARMERO - Tolima", "codigo" => "73055"], // [cite: 61]
            ["nombre" => "ATACO - Tolima", "codigo" => "73067"], // [cite: 61]
            ["nombre" => "CAJAMARCA - Tolima", "codigo" => "73124"], // [cite: 61]
            ["nombre" => "CARMEN DE APICALÁ - Tolima", "codigo" => "73148"], // [cite: 61]
            ["nombre" => "CASABIANCA - Tolima", "codigo" => "73152"], // [cite: 61]
            ["nombre" => "CHAPARRAL - Tolima", "codigo" => "73168"], // [cite: 61]
            ["nombre" => "COELLO - Tolima", "codigo" => "73200"], // [cite: 61]
            ["nombre" => "COYAIMA - Tolima", "codigo" => "73217"], // [cite: 61]
            ["nombre" => "CUNDAY - Tolima", "codigo" => "73226"], // [cite: 61]
            ["nombre" => "DOLORES - Tolima", "codigo" => "73236"], // [cite: 61]
            ["nombre" => "ESPINAL - Tolima", "codigo" => "73268"], // [cite: 61]
            ["nombre" => "FALAN - Tolima", "codigo" => "73270"], // [cite: 61]
            ["nombre" => "FLANDES - Tolima", "codigo" => "73275"], // [cite: 61]
            ["nombre" => "FRESNO - Tolima", "codigo" => "73283"], // [cite: 61]
            ["nombre" => "GUAMO - Tolima", "codigo" => "73319"], // [cite: 61]
            ["nombre" => "HERVEO - Tolima", "codigo" => "73347"], // [cite: 61]
            ["nombre" => "HONDA - Tolima", "codigo" => "73349"], // [cite: 61]
            ["nombre" => "ICONONZO - Tolima", "codigo" => "73352"], // [cite: 61]
            ["nombre" => "LÉRIDA - Tolima", "codigo" => "73408"], // [cite: 61]
            ["nombre" => "LÍBANO - Tolima", "codigo" => "73411"], // [cite: 61]
            ["nombre" => "MARIQUITA - Tolima", "codigo" => "73443"], // [cite: 61]
            ["nombre" => "MELGAR - Tolima", "codigo" => "73449"], // [cite: 61]
            ["nombre" => "MURILLO - Tolima", "codigo" => "73461"], // [cite: 61]
            ["nombre" => "NATAGAIMA - Tolima", "codigo" => "73483"], // [cite: 61]
            ["nombre" => "ORTEGA - Tolima", "codigo" => "73504"], // [cite: 61]
            ["nombre" => "PALOCABILDO - Tolima", "codigo" => "73520"], // [cite: 61]
            ["nombre" => "PIEDRAS - Tolima", "codigo" => "73547"], // [cite: 61]
            ["nombre" => "PLANADAS - Tolima", "codigo" => "73555"], // [cite: 61]
            ["nombre" => "PRADO - Tolima", "codigo" => "73563"], // [cite: 61]
            ["nombre" => "PURIFICACIÓN - Tolima", "codigo" => "73585"], // [cite: 61]
            ["nombre" => "RIOBLANCO - Tolima", "codigo" => "73616"], // [cite: 61]
            ["nombre" => "RONCESVALLES - Tolima", "codigo" => "73622"], // [cite: 61]
            ["nombre" => "ROVIRA - Tolima", "codigo" => "73624"], // [cite: 61]
            ["nombre" => "SALDAÑA - Tolima", "codigo" => "73671"], // [cite: 61]
            ["nombre" => "SAN ANTONIO - Tolima", "codigo" => "73675"], // [cite: 61]
            ["nombre" => "SAN LUIS - Tolima", "codigo" => "73678"], // [cite: 62]
            ["nombre" => "SANTA ISABEL - Tolima", "codigo" => "73686"], // [cite: 62]
            ["nombre" => "SUÁREZ - Tolima", "codigo" => "73770"], // [cite: 62]
            ["nombre" => "VALLE DE SAN JUAN - Tolima", "codigo" => "73854"], // [cite: 62]
            ["nombre" => "VENADILLO - Tolima", "codigo" => "73861"], // [cite: 62]
            ["nombre" => "VILLAHERMOSA - Tolima", "codigo" => "73870"], // [cite: 62]
            ["nombre" => "VILLARRICA - Tolima", "codigo" => "73873"], // [cite: 62]

            // --- VALLE DEL CAUCA ---
            ["nombre" => "CALI - Valle del Cauca", "codigo" => "76001"], // [cite: 62]
            ["nombre" => "ALCALÁ - Valle del Cauca", "codigo" => "76020"], // [cite: 62]
            ["nombre" => "ANDALUCÍA - Valle del Cauca", "codigo" => "76036"], // [cite: 62]
            ["nombre" => "ANSERMANUEVO - Valle del Cauca", "codigo" => "76041"], // [cite: 62]
            ["nombre" => "ARGELIA - Valle del Cauca", "codigo" => "76054"], // [cite: 62]
            ["nombre" => "BOLÍVAR - Valle del Cauca", "codigo" => "76100"], // [cite: 62]
            ["nombre" => "BUENAVENTURA - Valle del Cauca", "codigo" => "76109"], // [cite: 62]
            ["nombre" => "GUADALAJARA DE BUGA - Valle del Cauca", "codigo" => "76111"], // [cite: 62]
            ["nombre" => "BUGALAGRANDE - Valle del Cauca", "codigo" => "76113"], // [cite: 62]
            ["nombre" => "CAICEDONIA - Valle del Cauca", "codigo" => "76122"], // [cite: 62]
            ["nombre" => "CALIMA - Valle del Cauca", "codigo" => "76126"], // [cite: 62]
            ["nombre" => "CANDELARIA - Valle del Cauca", "codigo" => "76130"], // [cite: 62]
            ["nombre" => "CARTAGO - Valle del Cauca", "codigo" => "76147"], // [cite: 62]
            ["nombre" => "DAGUA - Valle del Cauca", "codigo" => "76233"], // [cite: 62]
            ["nombre" => "EL ÁGUILA - Valle del Cauca", "codigo" => "76243"], // [cite: 62]
            ["nombre" => "EL CAIRO - Valle del Cauca", "codigo" => "76246"], // [cite: 62]
            ["nombre" => "EL CERRITO - Valle del Cauca", "codigo" => "76248"], // [cite: 62]
            ["nombre" => "EL DOVIO - Valle del Cauca", "codigo" => "76250"], // [cite: 62]
            ["nombre" => "FLORIDA - Valle del Cauca", "codigo" => "76275"], // [cite: 62]
            ["nombre" => "GINEBRA - Valle del Cauca", "codigo" => "76306"], // [cite: 62]
            ["nombre" => "GUACARÍ - Valle del Cauca", "codigo" => "76318"], // [cite: 62]
            ["nombre" => "JAMUNDÍ - Valle del Cauca", "codigo" => "76364"], // [cite: 62]
            ["nombre" => "LA CUMBRE - Valle del Cauca", "codigo" => "76377"], // [cite: 62]
            ["nombre" => "LA UNIÓN - Valle del Cauca", "codigo" => "76400"], // [cite: 62]
            ["nombre" => "LA VICTORIA - Valle del Cauca", "codigo" => "76403"], // [cite: 62]
            ["nombre" => "OBANDO - Valle del Cauca", "codigo" => "76497"], // [cite: 62]
            ["nombre" => "PALMIRA - Valle del Cauca", "codigo" => "76520"], // [cite: 62]
            ["nombre" => "PRADERA - Valle del Cauca", "codigo" => "76563"], // [cite: 62]
            ["nombre" => "RESTREPO - Valle del Cauca", "codigo" => "76606"], // [cite: 62]
            ["nombre" => "RIOFRÍO - Valle del Cauca", "codigo" => "76616"], // [cite: 62]
            ["nombre" => "ROLDANILLO - Valle del Cauca", "codigo" => "76622"], // [cite: 62]
            ["nombre" => "SAN PEDRO - Valle del Cauca", "codigo" => "76670"], // [cite: 62]
            ["nombre" => "SEVILLA - Valle del Cauca", "codigo" => "76736"], // [cite: 62]
            ["nombre" => "TORO - Valle del Cauca", "codigo" => "76823"], // [cite: 63]
            ["nombre" => "TRUJILLO - Valle del Cauca", "codigo" => "76828"], // [cite: 63]
            ["nombre" => "TULUÁ - Valle del Cauca", "codigo" => "76834"], // [cite: 63]
            ["nombre" => "ULLOA - Valle del Cauca", "codigo" => "76845"], // [cite: 63]
            ["nombre" => "VERSALLES - Valle del Cauca", "codigo" => "76863"], // [cite: 63]
            ["nombre" => "VIJES - Valle del Cauca", "codigo" => "76869"], // [cite: 63]
            ["nombre" => "YOTOCO - Valle del Cauca", "codigo" => "76890"], // [cite: 63]
            ["nombre" => "YUMBO - Valle del Cauca", "codigo" => "76892"], // [cite: 63]
            ["nombre" => "ZARZAL - Valle del Cauca", "codigo" => "76895"], // [cite: 63]

            // --- ARAUCA ---
            ["nombre" => "ARAUCA - Arauca", "codigo" => "81001"], // [cite: 63]
            ["nombre" => "ARAUQUITA - Arauca", "codigo" => "81065"], // [cite: 63]
            ["nombre" => "CRAVO NORTE - Arauca", "codigo" => "81220"], // [cite: 63]
            ["nombre" => "FORTUL - Arauca", "codigo" => "81300"], // [cite: 63]
            ["nombre" => "PUERTO RONDÓN - Arauca", "codigo" => "81591"], // [cite: 63]
            ["nombre" => "SARAVENA - Arauca", "codigo" => "81736"], // [cite: 63]
            ["nombre" => "TAME - Arauca", "codigo" => "81794"], // [cite: 63]

            // --- CASANARE ---
            ["nombre" => "YOPAL - Casanare", "codigo" => "85001"], // [cite: 63]
            ["nombre" => "AGUAZUL - Casanare", "codigo" => "85010"], // [cite: 63]
            ["nombre" => "CHAMEZA - Casanare", "codigo" => "85015"], // [cite: 63]
            ["nombre" => "HATO COROZAL - Casanare", "codigo" => "85125"], // [cite: 63]
            ["nombre" => "LA SALINA - Casanare", "codigo" => "85136"], // [cite: 63]
            ["nombre" => "MANÍ - Casanare", "codigo" => "85139"], // [cite: 63]
            ["nombre" => "MONTERREY - Casanare", "codigo" => "85225"], // [cite: 63]
            ["nombre" => "NUNCHÍA - Casanare", "codigo" => "85225"], // [cite: 63]
            ["nombre" => "OROCUÉ - Casanare", "codigo" => "85230"], // [cite: 63]
            ["nombre" => "PAZ DE ARIPORO - Casanare", "codigo" => "85250"], // [cite: 63]
            ["nombre" => "PORE - Casanare", "codigo" => "85263"], // [cite: 63]
            ["nombre" => "RECETOR - Casanare", "codigo" => "85279"], // [cite: 63]
            ["nombre" => "SABANALARGA - Casanare", "codigo" => "85300"], // [cite: 63]
            ["nombre" => "SÁCAMA - Casanare", "codigo" => "85315"], // [cite: 63]
            ["nombre" => "SAN LUIS DE PALENQUE - Casanare", "codigo" => "85325"], // [cite: 63]
            ["nombre" => "TÁMARA - Casanare", "codigo" => "85400"], // [cite: 63]
            ["nombre" => "TAURAMENA - Casanare", "codigo" => "85410"], // [cite: 63]
            ["nombre" => "TRINIDAD - Casanare", "codigo" => "85430"], // [cite: 63]
            ["nombre" => "VILLANUEVA - Casanare", "codigo" => "85440"], // [cite: 63]

            // --- PUTUMAYO ---
            ["nombre" => "MOCOA - Putumayo", "codigo" => "86001"], // [cite: 63]
            ["nombre" => "COLÓN - Putumayo", "codigo" => "86219"], // [cite: 63]
            ["nombre" => "ORITO - Putumayo", "codigo" => "86320"], // [cite: 63]
            ["nombre" => "PUERTO ASÍS - Putumayo", "codigo" => "86568"], // [cite: 63]
            ["nombre" => "PUERTO CAICEDO - Putumayo", "codigo" => "86569"], // [cite: 63]
            ["nombre" => "PUERTO GUZMÁN - Putumayo", "codigo" => "86571"], // [cite: 64]
            ["nombre" => "LEGUÍZAMO - Putumayo", "codigo" => "86573"], // [cite: 64]
            ["nombre" => "SIBUNDOY - Putumayo", "codigo" => "86749"], // [cite: 64]
            ["nombre" => "SAN FRANCISCO - Putumayo", "codigo" => "86755"], // [cite: 64]
            ["nombre" => "SAN MIGUEL - Putumayo", "codigo" => "86757"], // [cite: 64]
            ["nombre" => "SANTIAGO - Putumayo", "codigo" => "86760"], // [cite: 64]
            ["nombre" => "VALLE DEL GUAMUEZ - Putumayo", "codigo" => "86865"], // [cite: 64]
            ["nombre" => "VILLAGARZÓN - Putumayo", "codigo" => "86885"], // [cite: 64]

            // --- ARCHIPIÉLAGO DE SAN ANDRÉS ---
            ["nombre" => "SAN ANDRÉS - San Andrés", "codigo" => "88001"], // [cite: 64]
            ["nombre" => "PROVIDENCIA - San Andrés", "codigo" => "88564"], // [cite: 64]

            // --- AMAZONAS ---
            ["nombre" => "LETICIA - Amazonas", "codigo" => "91001"], // [cite: 64]
            ["nombre" => "EL ENCANTO - Amazonas", "codigo" => "91263"], // [cite: 64]
            ["nombre" => "LA CHORRERA - Amazonas", "codigo" => "91405"], // [cite: 64]
            ["nombre" => "LA PEDRERA - Amazonas", "codigo" => "91407"], // [cite: 64]
            ["nombre" => "LA VICTORIA - Amazonas", "codigo" => "91430"], // [cite: 64]
            ["nombre" => "MIRITI - PARANÁ - Amazonas", "codigo" => "91460"], // [cite: 64]
            ["nombre" => "PUERTO ALEGRÍA - Amazonas", "codigo" => "91530"], // [cite: 64]
            ["nombre" => "PUERTO ARICA - Amazonas", "codigo" => "91536"], // [cite: 64]
            ["nombre" => "PUERTO NARIÑO - Amazonas", "codigo" => "91540"], // [cite: 64]
            ["nombre" => "PUERTO SANTANDER - Amazonas", "codigo" => "91669"], // [cite: 64]
            ["nombre" => "TARAPACÁ - Amazonas", "codigo" => "91798"], // [cite: 64]

            // --- GUAINÍA ---
            ["nombre" => "INÍRIDA - Guainía", "codigo" => "94001"], // [cite: 64]
            ["nombre" => "BARRANCO MINAS - Guainía", "codigo" => "94343"], // [cite: 64]
            ["nombre" => "MAPIRIPANA - Guainía", "codigo" => "94663"], // [cite: 64]
            ["nombre" => "SAN FELIPE - Guainía", "codigo" => "94883"], // [cite: 64]
            ["nombre" => "PUERTO COLOMBIA - Guainía", "codigo" => "94884"], // [cite: 64]
            ["nombre" => "LA GUADALUPE - Guainía", "codigo" => "94885"], // [cite: 64]
            ["nombre" => "CACAHUAL - Guainía", "codigo" => "94886"], // [cite: 64]
            ["nombre" => "PANA PANA - Guainía", "codigo" => "94887"], // [cite: 64]
            ["nombre" => "MORICHAL - Guainía", "codigo" => "94888"], // [cite: 64]

            // --- GUAVIARE ---
            ["nombre" => "SAN JOSÉ DEL GUAVIARE - Guaviare", "codigo" => "95001"], // [cite: 64]
            ["nombre" => "CALAMAR - Guaviare", "codigo" => "95015"], // [cite: 64]
            ["nombre" => "EL RETORNO - Guaviare", "codigo" => "95025"], // [cite: 64]
            ["nombre" => "MIRAFLORES - Guaviare", "codigo" => "95200"], // [cite: 64]

            // --- VAUPÉS ---
            ["nombre" => "MITÚ - Vaupés", "codigo" => "97001"], // [cite: 64]
            ["nombre" => "CARURU - Vaupés", "codigo" => "97161"], // [cite: 64]
            ["nombre" => "PACOA - Vaupés", "codigo" => "97511"], // [cite: 65]
            ["nombre" => "TARAIRA - Vaupés", "codigo" => "97666"], // [cite: 65]
            ["nombre" => "PAPUNAUA - Vaupés", "codigo" => "97777"], // [cite: 65]
            ["nombre" => "YAVARATÉ - Vaupés", "codigo" => "97889"], // [cite: 65]

            // --- VICHADA ---
            ["nombre" => "PUERTO CARREÑO - Vichada", "codigo" => "99001"], // [cite: 66]
            ["nombre" => "LA PRIMAVERA - Vichada", "codigo" => "99524"], // [cite: 66]
            ["nombre" => "SANTA ROSALÍA - Vichada", "codigo" => "99624"], // [cite: 66]
            ["nombre" => "CUMARIBO - Vichada", "codigo" => "99773"], // [cite: 66]
        ];

        foreach ($ciudades as $datos) {
            Ciudad::create([
                'nombre' => $datos['nombre'],
                'codigo_postal' => $datos['codigo'],
                'created_at' => '2026-02-02 01:13:24',
                'updated_at' => '2026-02-02 01:13:24',
            ]);
        }



        //******************* ESTADOS DE LA GUIA  ****************** */

        $tiposEntrega = [

            [
                'nombre' => 'Sobre',
                'descripcion' => 'Documentos, cartas, contratos y correspondencia.'
            ],

            [
                'nombre' => 'Paquete Pequeño',
                'descripcion' => 'Paquetes entre 1 y 5 kilogramos.'
            ],

            [
                'nombre' => 'Paquete Mediano',
                'descripcion' => 'Paquetes entre 6 y 12 kilogramos.'
            ],

            [
                'nombre' => 'Paquete Grande',
                'descripcion' => 'Paquetes entre 13 y 40 kilogramos.'
            ],

            [
                'nombre' => 'Carga Pesada',
                'descripcion' => 'Mercancía entre 41 y 400 kilogramos.'
            ],

            [
                'nombre' => 'Carga Paletizada',
                'descripcion' => 'Mercancía organizada en estibas o pallets.'
            ],

            [
                'nombre' => 'Mercancía Frágil',
                'descripcion' => 'Artículos delicados que requieren manejo especial.'
            ],

            [
                'nombre' => 'Mercancía Refrigerada',
                'descripcion' => 'Productos que requieren control de temperatura.'
            ],

            [
                'nombre' => 'Entrega Estándar',
                'descripcion' => 'Servicio normal de entrega.'
            ],

            [
                'nombre' => 'Entrega Urgente',
                'descripcion' => 'Servicio prioritario con tiempos reducidos.'
            ],

            [
                'nombre' => 'Entrega Express',
                'descripcion' => 'Entrega el mismo día o en pocas horas.'
            ],

            [
                'nombre' => 'Servicio Especial',
                'descripcion' => 'Envíos con requerimientos especiales.'
            ],

            [
                'nombre' => 'Contra Entrega',
                'descripcion' => 'Cobro del envío al momento de la entrega.'
            ],

            [
                'nombre' => 'Recolección Programada',
                'descripcion' => 'Recogida en fecha y hora acordada.'
            ],

            [
                'nombre' => 'Entrega Programada',
                'descripcion' => 'Entrega en fecha específica solicitada por el cliente.'
            ],

            [
                'nombre' => 'Envío Nacional',
                'descripcion' => 'Transporte dentro del territorio nacional.'
            ],

            [
                'nombre' => 'Envío Internacional',
                'descripcion' => 'Transporte con destino fuera del país.'
            ]

        ];

        foreach ($tiposEntrega as $tipo) {

            TipoEntrega::create([
                'nombre' => $tipo['nombre'],
                'descripcion' => $tipo['descripcion'],
                'estado' => 1
            ]);
        }



        //******************* CLIENTES ****************** */

        $clientes = [];

        /* $faker = Faker\Factory::create('es_CO'); */
        $faker = Factory::create('es_CO');

        for ($i = 1; $i <= 100; $i++) {

            $clientes[] = [
                'cedula' => $faker->unique()->numberBetween(10000000, 99999999),
                'nombre' => $faker->name(),
                'telefono' => $faker->numerify('3#########'),
                'correo' => $faker->unique()->safeEmail(),
                'direccion' => $faker->streetAddress(),
                'id_ciudad' => rand(1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Cliente::insert($clientes);







        //*******************  ROL ****************** */

        $rol1 = new Rol();

        $rol1->nombreRol = "Super Administrador";        
        $rol1->created_at = "2026-02-02 01:13:24";
        $rol1->updated_at = "2026-02-02 01:13:24";
        $rol1->save();


        $rol2 = new Rol();

        $rol2->nombreRol = "Administrador";
        $rol2->created_at = "2026-02-02 01:13:24";
        $rol2->updated_at = "2026-02-02 01:13:24";
        $rol2->save();

        $rol3 = new Rol();

        $rol3->nombreRol = "Auxiliar Administrativo";
        $rol3->created_at = "2026-02-02 01:13:24";
        $rol3->updated_at = "2026-02-02 01:13:24";
        $rol3->save();

        $rol4 = new Rol();

        $rol4->nombreRol = "Mensajero";
        $rol4->created_at = "2026-02-02 01:13:24";
        $rol4->updated_at = "2026-02-02 01:13:24";
        $rol4->save();



        //******************* TIPO VEHICULO  ******************* */

        $tipoVehiculo1 = new TipoVehiculo();

        $tipoVehiculo1->nombre = "Carro";
        $tipoVehiculo1->descripcion = "carro particular de 4 puertas";
        $tipoVehiculo1->created_at = "2026-02-02 01:13:24";
        $tipoVehiculo1->updated_at = "2026-02-02 01:13:24";
        $tipoVehiculo1->save();

        $tipoVehiculo2 = new TipoVehiculo();

        $tipoVehiculo2->nombre = "Moto";
        $tipoVehiculo2->descripcion = "Motocicleta de reparto ágil para entregas rápidas";
        $tipoVehiculo2->created_at = "2026-02-02 01:13:24";
        $tipoVehiculo2->updated_at = "2026-02-02 01:13:24";
        $tipoVehiculo2->save();



        $tipoVehiculo3 = new TipoVehiculo();

        $tipoVehiculo3->nombre = "Camion";
        $tipoVehiculo3->descripcion = "Vehículo de carga para entregas a larga distancia";
        $tipoVehiculo3->created_at = "2026-02-02 01:13:24";
        $tipoVehiculo3->updated_at = "2026-02-02 01:13:24";
        $tipoVehiculo3->save();


        //*******************  VEHICULO  ******************* */

        $vehiculo1 = new Vehiculo();

        $vehiculo1->placa = "ABC123";
        $vehiculo1->marca = "Toyota";
        $vehiculo1->modelo = "Corolla 2020";
        $vehiculo1->capacidad = "500";
        $vehiculo1->estado = "activo";
        $vehiculo1->fecha_registro = "2026-02-02";
        $vehiculo1->id_tipo_vehiculo = "1";       
        $vehiculo1->created_at = "2026-02-02 01:13:24";
        $vehiculo1->updated_at = "2026-02-02 01:13:24";
        $vehiculo1->save();


        $vehiculo2 = new Vehiculo();

        $vehiculo2->placa = "AZZ-23H";
        $vehiculo2->marca = "YAMAHA";
        $vehiculo2->modelo = "XTZ 250";
        $vehiculo2->capacidad = "100";
        $vehiculo2->estado = "activo";
        $vehiculo2->fecha_registro = "2026-02-02";
        $vehiculo2->id_tipo_vehiculo = "2";
        $vehiculo2->created_at = "2026-02-02 01:13:24";
        $vehiculo2->updated_at = "2026-02-02 01:13:24";
        $vehiculo2->save();



        //*******************  USUARIO  ****************** */


        $usuario1 = new Usuario();

        $usuario1->nombre = "jose rodriguez";
        $usuario1->email = "jose@example.com";
        $usuario1->password = bcrypt("password");
        $usuario1->id_rol = "2";
        $usuario1->id_vehiculo = "1";
        $usuario1->created_at = "2026-02-02 01:13:24";
        $usuario1->updated_at = "2026-02-02 01:13:24";
        $usuario1->save();







        //************************************* */

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        //************************************* */


    }
}
