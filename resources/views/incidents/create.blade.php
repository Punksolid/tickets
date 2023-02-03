@extends('adminlte::page')

@section('title', 'Nuevo Reporte')

@section('content_header')
    <h1>Registra un Reporte al Ayuntamiento de Culiacan.</h1>
    <span> Esta es una pagina <b>NO OFICIAL</b>, aunque tu reporte lo puedes verificar en la plataforma del ayuntamiento, no hay
    garantia de que lo resuelvan y no nos hacemos responsables del contenido expuesto.</span>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
{{--                    error block --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--                    crea nuevo formulario--}}
                    <form id="create_incident" method="POST" action="https://apps.culiacan.gob.mx/ciudadano/reportes/registrar_reporte">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Tipo de servicio</label>
                            <select class="form-control select2-blue @error('service_type_id') is-invalid @enderror" id="service_type_id" name="service_type_id">
                                <option value="">Selecciona un tipo de servicio</option>
                                @foreach($services_types as $key => $service_type_name)
                                    <option value="{{ $key }}" @if($key == old('service_type_id')) selected="selected" @endif >{{ $service_type_name }}</option>
                                @endforeach
                            </select>
                            @error('service_type_id')
                                @foreach($errors->get('service_type_id') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="report_message">Descripción</label>
                            <textarea class="form-control @error('report_message') is-invalid @enderror" id="report_message" name="report_message" rows="3">{{ old('report_message') }}</textarea>
                            @if($errors->has('report_message'))
                                @foreach($errors->get('report_message') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="neighborhood_id">Colonia</label>
                            <select class="form-control select2-blue" id="neighborhood_id" name="neighborhood_id">
                                <option selected="selected" value="">Seleccione</option>
                                <option value="1930">CENTRO</option>
                                <option value="1931">CULIACANCITO</option>
                                <option value="1942">VILLA ADOLFO LÓPEZ MATEOS EL TAMARINDO</option>
                                <option value="2110">AYUNE</option>
                                <option value="2109">EJIDO LOS NARANJOS</option>
                                <option value="2112">FRACC. LA CASTELLANA</option>
                                <option value="2107">Nuevo Mundo</option>
                                <option value="2111">SINDICATURA CULIACANCITO</option>
                                <option value="1951">ARGENTINA 2</option>
                                <option value="2088">BACHIGUALATITO</option>
                                <option value="2011">BACURIMI</option>
                                <option value="2012">BELLAVISTA</option>
                                <option value="1682">BAILA</option>
                                <option value="1946">POBLADO BELLAVISTA</option>
                                <option value="1947">SINDICATURA DE CULIACANCITO</option>
                                <option value="1983">CAMPO ACAPULCO</option>
                                <option value="1686">CAMPO ARGENTINA</option>
                                <option value="2046">CAMPO CANAN</option>
                                <option value="2042">CAMPO CANAN O LA FLOR</option>
                                <option value="1987">SAN RAFAEL DE COSTA RICA</option>
                                <option value="2033">CAMPO CUBA</option>
                                <option value="2079">CAMPO EL CARDENAL 1</option>
                                <option value="1977">CAMPO EL HUARACHE</option>
                                <option value="1943">CAMPO EL MILAGRO</option>
                                <option value="1897">CAMPO EL PORVENIR</option>
                                <option value="2045">CAMPO EL SOL</option>
                                <option value="1844">CAMPO EUREKA</option>
                                <option value="2035">CAMPO EXPERIMENTAL</option>
                                <option value="2043">CAMPO LA BAQUETA</option>
                                <option value="2010">CAMPO LA FLOR</option>
                                <option value="1886">AGUARUTO</option>
                                <option value="1887">CAMPO MOROLEON</option>
                                <option value="2047">CAMPO NORA</option>
                                <option value="1985">CAMPO NUEVO MÉXICO</option>
                                <option value="1687">CAMPO EL CHORIZO</option>
                                <option value="1688">FRENTE AL CAMPO EL PARALELO 38</option>
                                <option value="1959">CAMPO PODESTA</option>
                                <option value="2048">SAN MIGUEL EL ALTO</option>
                                <option value="2019">CAMPO SANTA FE</option>
                                <option value="1692">PLAN DE ORIENTE - EL 12</option>
                                <option value="1696">CAMPO PESQUERO COSPITA</option>
                                <option value="1698">COSPITA</option>
                                <option value="1704">LAGUNA DE CANACHI</option>
                                <option value="1709">18 DE MARZO</option>
                                <option value="1710">ALBERGUE CAÑERO</option>
                                <option value="1711">ALONDRAS</option>
                                <option value="1714">AMPLIACIÓN CAÑITAS</option>
                                <option value="1715">AMPLIACIÓN ZARAGOZA</option>
                                <option value="1717">BARRIO ESTACIÓN</option>
                                <option value="1719">BENITO JUÁREZ NORTE</option>
                                <option value="1720">BENITO JUÁREZ SUR</option>
                                <option value="1722">CENTRO</option>
                                <option value="1726">CONSTITUYENTES</option>
                                <option value="1727">COSTA RICA</option>
                                <option value="1730">ESTACIÓN CANAL DE LOS CHINOS</option>
                                <option value="1731">FRANCISCO VILLA</option>
                                <option value="1732">GENERAL EMILIANO ZAPATA</option>
                                <option value="1735">IGNACIO ZARAGOZA</option>
                                <option value="1736">INFONAVIT DEL REAL</option>
                                <option value="1738">INFONAVIT MILAGROS</option>
                                <option value="1739">INFONAVIT PRADOS DEL SOL</option>
                                <option value="1740">INFONAVIT REALIDAD</option>
                                <option value="1757">JESÚS DIAS FRANCO</option>
                                <option value="1743">JUAN DE DIOS BÁTIZ</option>
                                <option value="1744">JUAN DE DIOS VÁZQUEZ</option>
                                <option value="1746">LAS ALONDRAS</option>
                                <option value="1749">LAS CARPAS</option>
                                <option value="1752">OBRERA</option>
                                <option value="1755">POPULAR</option>
                                <option value="1756">PRADOS DEL SOL</option>
                                <option value="1758">REAL DEL SOL</option>
                                <option value="1759">REALITOS</option>
                                <option value="1723">RENATO VEGA AMADOR</option>
                                <option value="1763">SAN ÁNGEL</option>
                                <option value="1764">SAN RAFAEL</option>
                                <option value="1724">SINALOA</option>
                                <option value="1768">SINDICATURA DE COSTA RICA</option>
                                <option value="1771">SOLIDARIDAD CAMPESINA</option>
                                <option value="1772">STASAC</option>
                                <option value="1774">VERACRUZ</option>
                                <option value="1775">VILLA RICA</option>
                                <option value="1776">ZAPATA</option>
                                <option value="1777">ZARAGOZA</option>
                                <option value="849">10 DE ABRIL</option>
                                <option value="850">10 DE MAYO</option>
                                <option value="852">12 DE DICIEMBRE</option>
                                <option value="853">16 DE SEPTIEMBRE</option>
                                <option value="855">20 DE NOVIEMBRE</option>
                                <option value="859">21 DE MARZO</option>
                                <option value="863">22 DE DICIEMBRE</option>
                                <option value="866">3 RÍOS</option>
                                <option value="868">4 DE MARZO</option>
                                <option value="870">5 DE FEBRERO</option>
                                <option value="871">5 DE MAYO</option>
                                <option value="1061">5-febr.</option>
                                <option value="873">6 DE ENERO</option>
                                <option value="874">7 GOTAS</option>
                                <option value="1427">8 DE FEBRERO</option>
                                <option value="876">ACUEDUCTO</option>
                                <option value="877">ACUEDUCTO III</option>
                                <option value="879">ADOLFO LÓPEZ MATEOS</option>
                                <option value="881">AEROPUERTO</option>
                                <option value="883">AGRARISTA MEXICANA</option>
                                <option value="884">AGUARUTO</option>
                                <option value="886">AGUARUTO CENTRO</option>
                                <option value="890">AGUARUTO VIEJO</option>
                                <option value="892">AGUSTINA RAMÍREZ</option>
                                <option value="895">ALAMEDA</option>
                                <option value="903">ALTOS DE BACHIGUALATO</option>
                                <option value="2105">ALTURAS DEL SUR</option>
                                <option value="905">AMADO NERVO</option>
                                <option value="906">AMAPAS AGUARUTO</option>
                                <option value="910">AMPLIACIÓN AMISTAD</option>
                                <option value="911">AMPLIACIÓN ANTONIO TOLEDO CORRO</option>
                                <option value="913">AMPLIACIÓN BUENAVISTA</option>
                                <option value="914">AMPLIACIÓN BUENOS AIRES</option>
                                <option value="915">AMPLIACIÓN CNOP</option>
                                <option value="916">AMPLIACIÓN DE LÁZARO CÁRDENAS</option>
                                <option value="917">AMPLIACIÓN EL BARRIO</option>
                                <option value="918">AMPLIACIÓN FLORIDA</option>
                                <option value="919">AMPLIACIÓN HUIZACHES</option>
                                <option value="897">AMPLIACION HUMAYA</option>
                                <option value="920">AMPLIACIÓN HUMAYA</option>
                                <option value="921">AMPLIACIÓN INDEPENDENCIA</option>
                                <option value="923">AMPLIACIÓN JUNTAS DE HUMAYA</option>
                                <option value="926">AMPLIACIÓN LÁZARO CÁRDENAS</option>
                                <option value="927">AMPLIACIÓN LOMA DE RODRIGUERA</option>
                                <option value="928">AMPLIACIÓN LOMBARDO TOLEDANO</option>
                                <option value="929">AMPLIACIÓN LUIS DONALDO COLOSIO</option>
                                <option value="930">AMPLIACIÓN MIGUEL DE LA MADRID</option>
                                <option value="931">AMPLIACIÓN MIRADOR</option>
                                <option value="932">AMPLIACIÓN MOTESIERRA</option>
                                <option value="933">AMPLIACIÓN PEMEX</option>
                                <option value="934">AMPLIACIÓN RUBÉN JARAMILLO</option>
                                <option value="935">AMPLIACIÓN RUIZ</option>
                                <option value="936">AMPLIACIÓN SAN BENITO</option>
                                <option value="939">AMPLIACIÓN VALLE DEL RÍO</option>
                                <option value="940">AMPLIACIÓN VISTA HERMOSA</option>
                                <option value="941">ANTONIO NAKAYAMA</option>
                                <option value="942">ANTONIO ROSALES</option>
                                <option value="943">ANTONIO TOLEDO CORRO</option>
                                <option value="944">AQUILES SERDÁN</option>
                                <option value="945">ARBOLEDAS</option>
                                <option value="946">ARCOS SUR</option>
                                <option value="947">AURORA</option>
                                <option value="948">AVIACIÓN</option>
                                <option value="949">AYUNTAMIENTO 85</option>
                                <option value="951">AZALEAS RESIDENCIAL</option>
                                <option value="952">AZUCENA</option>
                                <option value="954">BACHIGUALATO</option>
                                <option value="958">BACURIMI</option>
                                <option value="959">BALCONES DEL NUEVO CULIACÁN</option>
                                <option value="962">BARRANCOS</option>
                                <option value="964">BARRANCOS 2</option>
                                <option value="965">BARRANCOS 3</option>
                                <option value="966">BARRANCOS 4</option>
                                <option value="970">BARRIO PONCE</option>
                                <option value="971">BELLAVISTA</option>
                                <option value="973">BENITO JUÁREZ</option>
                                <option value="975">BODEGA QUINTERO</option>
                                <option value="976">BONANZA</option>
                                <option value="977">BONATERRA</option>
                                <option value="978">BOSQUES DEL HUMAYA</option>
                                <option value="979">BOSQUES DEL RÍO</option>
                                <option value="980">BRISAS DE HUMAYA</option>
                                <option value="982">BUENAVISTA</option>
                                <option value="983">BUENOS AIRES</option>
                                <option value="974">BUGAMBILIAS</option>
                                <option value="986">BURÓCRATA</option>
                                <option value="987">CAMINO REAL</option>
                                <option value="988">CAMPESINA EL BARRIO</option>
                                <option value="989">CAMPIÑA</option>
                                <option value="990">CAMPO AGRÍCOLA BATAN 1 AGUARUTO</option>
                                <option value="991">CAMPO AGRÍCOLA BATAN 2 AGUARUTO</option>
                                <option value="993">CAMPO BELLO</option>
                                <option value="994">CAMPO EL DIEZ</option>
                                <option value="995">CANACO</option>
                                <option value="997">CAÑADAS</option>
                                <option value="1000">CAPISTRANO RESIDENCIAL</option>
                                <option value="1003">CARPAS</option>
                                <option value="1004">CARRETERA A NAVOLATO</option>
                                <option value="1005">CENTRAL DE ABASTOS</option>
                                <option value="1006">CENTRAL NUEVO MILENIO</option>
                                <option value="1007">CENTRO</option>
                                <option value="1015">CHAPULTEPEC</option>
                                <option value="1020">CHULAVISTA</option>
                                <option value="1022">CIMAS DEL HUMAYA</option>
                                <option value="1024">CIUDAD UNIVERSITARIA</option>
                                <option value="1026">CNOP</option>
                                <option value="1028">COCINA ECONOMICA DEL MAR</option>
                                <option value="1029">COLINAS DE LAS RIVIERAS</option>
                                <option value="1033">COLINAS DE SAN ISIDRO</option>
                                <option value="1034">COLINAS DE SAN MIGUEL</option>
                                <option value="1035">COLINAS DEL BOSQUE</option>
                                <option value="1036">COLINAS DEL HUMAYA</option>
                                <option value="1037">COLINAS DEL PARQUE</option>
                                <option value="1038">COLINAS DEL REY</option>
                                <option value="1048">COMUNICADORES</option>
                                <option value="1049">CONGRESO DEL ESTADO</option>
                                <option value="1047">CONJUNTO HABITACIONAL BACHIGUALATO</option>
                                <option value="2102">CONSTITUCIÓN CROC</option>
                                <option value="2106">COUNTRY ALAMOS</option>
                                <option value="1051">COUNTRY DEL RÍO</option>
                                <option value="1054">CUAUHTÉMOC</option>
                                <option value="1058">CULIACÁN DE ROSALES</option>
                                <option value="2104">CUMBRES DEL SUR</option>
                                <option value="1059">DANUBIO</option>
                                <option value="1062">DE LAS TORRES</option>
                                <option value="1063">DEL CAMINO</option>
                                <option value="1066">DEMETRIO VALLEJO AGUARUTO</option>
                                <option value="1083">DESARROLLO URBANO LA PRIMAVERA</option>
                                <option value="1089">DIANA LAURA RIOJAS</option>
                                <option value="1090">DÍAZ ORDAZ</option>
                                <option value="1092">DOMINGO RUBÍ</option>
                                <option value="1093">EJIDAL</option>
                                <option value="1094">EJIDO EL RANCHITO</option>
                                <option value="1095">EJIDO HUMAYA</option>
                                <option value="1097">EL ALTO BACHIGUALATO</option>
                                <option value="1099">EL BARRIO</option>
                                <option value="1100">EL CENTENARIO</option>
                                <option value="1101">EL CENTRO</option>
                                <option value="1102">EL DIEZ</option>
                                <option value="1103">EL MIRADOR</option>
                                <option value="1104">EL NUEVO BACHIGUALATO</option>
                                <option value="1105">EL PALMITO</option>
                                <option value="1106">EL PALMITO VIEJO</option>
                                <option value="1107">EL PÍPILA</option>
                                <option value="1111">EL VALLADO NUEVO</option>
                                <option value="1112">EL VALLADO VIEJO</option>
                                <option value="1113">EMILIANO ZAPATA</option>
                                <option value="1117">ENRIQUE FÉLIX CASTRO</option>
                                <option value="882">ESPERANZA</option>
                                <option value="1121">ESTHELA ORTIZ DE TOLEDO</option>
                                <option value="1123">ESTRELLA NUEVA GALICIA</option>
                                <option value="1124">FACCIONAMIENTO LAS QUINTAS</option>
                                <option value="1125">FACCIONAMIENTO LOS LAURELES PINOS</option>
                                <option value="1126">FACCIONAMIENTO VALLE ALTO</option>
                                <option value="1127">FACCIONAMIENTO VILLAS DEL RÍO</option>
                                <option value="1131">FELIPE ÁNGELES</option>
                                <option value="1132">FERIA GANADERA</option>
                                <option value="1133">FERROCARRILERA</option>
                                <option value="1134">FIDEL VELÁZQUEZ</option>
                                <option value="2114">FINCAS DEL HUMAYA</option>
                                <option value="1135">FINISTERRA</option>
                                <option value="1136">FINISTERRA 3</option>
                                <option value="1138">FLORES MAGÓN</option>
                                <option value="1139">FLORIDA</option>
                                <option value="1140">FOVISSSTE CHAPULTEPEC</option>
                                <option value="1050">FOVISSSTE DIAMANTE II</option>
                                <option value="1147">FOVISSSTE HUMAYA DIAMANTES</option>
                                <option value="1148">FOVISSSTE NUEVA VISCAYA</option>
                                <option value="1149">FOVISSTE</option>
                                <option value="2108">FRACC. LOS CIRUELOS</option>
                                <option value="1162">FRACCIONAMIENNTO CAPISTRANO RESIDENCIAL</option>
                                <option value="1158">FRACCIONAMIENTO EL CENTENARIO</option>
                                <option value="1163">FRACCIONAMIENTO LOMALINDA</option>
                                <option value="2092">FRACCIONAMIENTO LOS ALMENDROS</option>
                                <option value="1160">FRACCIONAMIENTO LOS ÁNGELES</option>
                                <option value="2097">FRACCIONAMIENTO NUEVA GALICIA</option>
                                <option value="2095">FRACCIONAMIENTO PORTALEGRE</option>
                                <option value="2098">FRACCIONAMIENTO REAL CHAPULTEPEC</option>
                                <option value="2099">FRACCIONAMIENTO SANTA MARGARITA</option>
                                <option value="1314">FRACCIONAMIENTO TERRANOVA.</option>
                                <option value="2094">FRACCIONAMIENTO VALLE DE AMAPA</option>
                                <option value="2100">FRACCIONAMIENTO ZONA DORADA</option>
                                <option value="1159">FRACIONAMIENTO VINORAMAS</option>
                                <option value="1165">FRANCISCO ALARCÓN FREGOSO</option>
                                <option value="1130">FRANCISCO I MADERO</option>
                                <option value="1168">FRANCISCO VILLA</option>
                                <option value="1169">FUENTES DEL VALLE</option>
                                <option value="1171">GABRIEL LEYVA SOLANO</option>
                                <option value="1173">GASOLINERA DEL VALLE</option>
                                <option value="1174">GENARO ESTRADA</option>
                                <option value="1175">GRECIA</option>
                                <option value="2096">GUADALUPE</option>
                                <option value="1178">GUADALUPE VICTORIA</option>
                                <option value="1184">GUAUHTEMOC</option>
                                <option value="1185">GUSTAVO DÍAZ ORDAZ</option>
                                <option value="1188">HACIENDA</option>
                                <option value="1189">HACIENDA ALAMEDA</option>
                                <option value="1191">HACIENDA ARBOLEDAS</option>
                                <option value="1192">HACIENDA DE LA MORA</option>
                                <option value="1193">HACIENDA DE LA MORA ELITE</option>
                                <option value="1194">HACIENDA DEL RÍO</option>
                                <option value="1195">HACIENDA DEL VALLE</option>
                                <option value="1196">HACIENDA LOS HUERTOS</option>
                                <option value="1197">HACIENDA MOLINO DE FLORES</option>
                                <option value="1199">HACIENDA RESIDENCIAL</option>
                                <option value="1201">HERACLIO BERNAL</option>
                                <option value="1204">HORIZONTES</option>
                                <option value="1206">HUIZACHES</option>
                                <option value="1213">IGNACIO ALLENDE</option>
                                <option value="1214">INDEPENDENCIA</option>
                                <option value="1215">INDUSTRIAL</option>
                                <option value="1216">INDUSTRIAL BRAVO</option>
                                <option value="1217">INDUSTRIAL EL PALMITO</option>
                                <option value="1221">INFOBAVIT LAS FLORES</option>
                                <option value="1227">INFONAVIT CTM</option>
                                <option value="1211">INFONAVIT HUMAYA</option>
                                <option value="1233">INFONAVIT LAS FLORES</option>
                                <option value="1234">INFONAVIT PALMA COCOTERA</option>
                                <option value="1236">INFONAVIT PUNTAS DEL HUMAYA</option>
                                <option value="1237">INFONAVIT SOLIDARIDAD</option>
                                <option value="1239">INSTITUTO ESTATAL DE CIENCIAS PENALES Y SEGURIDAD PUBLICA</option>
                                <option value="1240">INSURGENTES</option>
                                <option value="1243">ISLA MUSALA</option>
                                <option value="1244">ISSSTESIN</option>
                                <option value="1246">JARDINES DE LA SIERRA</option>
                                <option value="1248">JARDINES DE SAN BARTOLOMÉ AGUARUTO</option>
                                <option value="1249">JARDINES DE SANTA FE</option>
                                <option value="1251">JARDINES DEL HUMAYA</option>
                                <option value="1252">JARDINES DEL PEDREGAL</option>
                                <option value="1254">JARDINES DEL VALLE</option>
                                <option value="1255">JESÚS MANUEL CAMEZ VALDEZ</option>
                                <option value="1257">JESÚS VALDEZ ALDANA</option>
                                <option value="1262">JORGE ALMADA</option>
                                <option value="1267">JOSEFA ORTIZ DE DOMÍNGUEZ</option>
                                <option value="1268">JUAN ALDAMA</option>
                                <option value="1269">JUAN DE DIOS BÁTIZ</option>
                                <option value="1271">JUNTAS DEL HUMAYA</option>
                                <option value="1272">LA AMISTAD</option>
                                <option value="1275">LA CAMPIÑA</option>
                                <option value="1276">LA CASCADA</option>
                                <option value="1277">LA CEIBA AGUARUTO</option>
                                <option value="1278">LA COMPUERTA DE AGUARUTO</option>
                                <option value="1279">LA CONDESA</option>
                                <option value="1002">LA CONQUISTA</option>
                                <option value="1281">LA COSTERA</option>
                                <option value="1282">LA COSTERITA</option>
                                <option value="1283">LA CROC</option>
                                <option value="1284">LA ESPERANZA</option>
                                <option value="1288">LA FLORIDA</option>
                                <option value="1289">LA LIMA</option>
                                <option value="1291">LA PUERTA</option>
                                <option value="1292">LA RIVERA DEL HUMAYA</option>
                                <option value="1294">LAS AMÉRICAS</option>
                                <option value="1042">LAS COLORADAS</option>
                                <option value="1043">LAS CUCAS</option>
                                <option value="1302">LAS GLORIAS</option>
                                <option value="1303">LAS HUERTAS</option>
                                <option value="1305">LAS ILUSIONES</option>
                                <option value="1306">LAS PALMAS</option>
                                <option value="1307">LAS PALOMAS</option>
                                <option value="1310">LAS QUINTAS</option>
                                <option value="1311">LAS TERRAZAS</option>
                                <option value="1312">LAS TORRES</option>
                                <option value="1293">LAS VEGAS</option>
                                <option value="1316">LAURELES PINOS</option>
                                <option value="1317">LÁZARO CÁRDENAS</option>
                                <option value="1044">LIBERTAD</option>
                                <option value="1323">LIRÍOS DEL RÍO</option>
                                <option value="1325">LOCALIDAD DE BACHIGUALATO</option>
                                <option value="1326">LOMA BONITA</option>
                                <option value="1327">LOMA DE RODRIGUERA</option>
                                <option value="1328">LOMA DE SAN ISIDRO</option>
                                <option value="1331">LOMAS DE BOULEVARD</option>
                                <option value="1332">LOMAS DE GUADALUPE</option>
                                <option value="1334">LOMAS DE MAGISTERIO</option>
                                <option value="1336">LOMAS DE TAMAZULA</option>
                                <option value="1338">LOMAS DEL HUMAYA</option>
                                <option value="1339">LOMAS DEL PEDREGAL</option>
                                <option value="1341">LOMAS DEL SOL</option>
                                <option value="1045">LOMBARDO TOLEDANO</option>
                                <option value="1348">LOS ALAMITOS</option>
                                <option value="1349">LOS ÁLAMOS</option>
                                <option value="1350">LOS ÁNGELES</option>
                                <option value="1351">LOS ARCOS</option>
                                <option value="1352">LOS CERRITOS</option>
                                <option value="1353">LOS FRESNOS</option>
                                <option value="1354">LOS GIRASOLES</option>
                                <option value="1355">LOS HELECHOS</option>
                                <option value="1357">LOS HUERTOS</option>
                                <option value="1358">LOS HUIZACHES</option>
                                <option value="1361">LOS LAURELES</option>
                                <option value="1365">LOS MEZCALES</option>
                                <option value="1368">LOS OLIVOS DEL RÍO</option>
                                <option value="1369">LOS PINOS</option>
                                <option value="1370">LOS PORTALES</option>
                                <option value="1371">LOS SAUCES</option>
                                <option value="1374">LOS SAUCES II</option>
                                <option value="1375">LUIS DONALDO COLOSIO</option>
                                <option value="1377">MARGARITA</option>
                                <option value="1378">MELCHOR OCAMPO</option>
                                <option value="1379">MERCADO DE ABASTOS</option>
                                <option value="1380">MEZQUITILLO</option>
                                <option value="848">MIGUEL ALEMÁN</option>
                                <option value="1382">MIGUEL DE LA MADRID</option>
                                <option value="1386">MIGUEL HIDALGO Y COSTILLA</option>
                                <option value="1389">MIRAVALLE</option>
                                <option value="1391">MOLINO LAS FLORES</option>
                                <option value="1393">MONTE BLANCO</option>
                                <option value="1394">MONTEBELLO</option>
                                <option value="1395">MONTECARLO</option>
                                <option value="2115">MONTESIERRA</option>
                                <option value="1398">MORELOS</option>
                                <option value="1406">NIÑOS HEROS ANTES ILUSIONES</option>
                                <option value="1407">NUEVA AGUARUTO</option>
                                <option value="1409">NUEVA ESTACIÓN</option>
                                <option value="1411">NUEVA GALAXIA</option>
                                <option value="1416">NUEVA VIZCAYA</option>
                                <option value="1417">NUEVO BACHIGUALATO</option>
                                <option value="1418">NUEVO CULIACÁN</option>
                                <option value="1421">NUEVO HORIZONTES</option>
                                <option value="1422">NUEVO MÉXICO</option>
                                <option value="1426">OBRERO CAMPESINO</option>
                                <option value="1428">OLIVOS DEL RÍO</option>
                                <option value="1431">PALERMO RESIDENCIAL</option>
                                <option value="1434">PARAÍSO Y FRACCIONAMIENTO LOS SAUCES</option>
                                <option value="1435">PARQUE ALAMEDA</option>
                                <option value="1437">PARQUE DEL REAL</option>
                                <option value="1439">PARQUE INDUSTRIAL CANACINTRA</option>
                                <option value="1440">PARQUE INDUSTRIAL CANACINTRA 2</option>
                                <option value="1442">PARQUE INDUSTRIAL EL TRÉBOL</option>
                                <option value="1443">PASEO AZTECA</option>
                                <option value="1444">PASEO DE LOS ARCOS</option>
                                <option value="1445">PASEO DEL RÍO</option>
                                <option value="1448">PEDREGAL DEL HUMAYA</option>
                                <option value="1449">PEMEX</option>
                                <option value="1450">PENITENCIARIA</option>
                                <option value="1451">PÍPILA</option>
                                <option value="1452">PLAN 3 RÍOS</option>
                                <option value="1455">PLUTARCO ELÍAS CALLES</option>
                                <option value="1459">PONIENTE EJIDO LAS FLORES</option>
                                <option value="1460">POPULAR</option>
                                <option value="2103">PORTALES DEL COUNTRY</option>
                                <option value="1461">PRADERA DORADA</option>
                                <option value="1463">PRADERA DORADA II</option>
                                <option value="1466">PRADOS DE LA CONQUISTA</option>
                                <option value="1467">PRADOS DEL SOL</option>
                                <option value="1469">PRADOS DEL SOL 2</option>
                                <option value="1475">PRADOS DEL SUR</option>
                                <option value="1477">PREDIO HUMAYA</option>
                                <option value="1478">PRIMER CUADRO</option>
                                <option value="1480">PRIVADA LA ESTANCIA 1</option>
                                <option value="1481">PRIVADA LA ESTANCIA 2</option>
                                <option value="1482">PRIVADA LA ESTANCIA 3</option>
                                <option value="1484">PRIVADA LA ESTANCIA 5</option>
                                <option value="1483">PRIVADA LA ESTANCIA 7</option>
                                <option value="1486">PRIVADA LA ESTANCIA 8</option>
                                <option value="1488">PRIVADA RIVERA DEL HUMAYA</option>
                                <option value="1489">PROGRESO</option>
                                <option value="1490">PROLONGACIÓN HUMAYA</option>
                                <option value="1491">PROVIDENCIA</option>
                                <option value="1493">QUINTA REAL</option>
                                <option value="1494">RAFAEL BUELNA</option>
                                <option value="1495">RANCHITO CHICHI</option>
                                <option value="1496">RANCHO CONTENTO II</option>
                                <option value="1498">REAL DE MINAS</option>
                                <option value="1499">REAL DEL PARQUE</option>
                                <option value="1500">REAL VIRREYES</option>
                                <option value="1502">RECURSOS HIDRÁULICOS</option>
                                <option value="1506">RENATO VEGA ALVARADO</option>
                                <option value="1508">RENATO VEGA AMADOR</option>
                                <option value="1509">REPÚBLICA MEXICANA</option>
                                <option value="1510">RESIDENCIAL</option>
                                <option value="1513">RESIDENCIAL ÁLAMOS CONTRY</option>
                                <option value="1514">RESIDENCIAL AZALEAS</option>
                                <option value="1515">RESIDENCIAL BONANZA</option>
                                <option value="1516">RESIDENCIAL CAMPESTRE</option>
                                <option value="1517">RESIDENCIAL COLINAS DE SAN MIGUEL</option>
                                <option value="1519">RESIDENCIAL DEL HUMAYA</option>
                                <option value="1520">RESIDENCIAL HACIENDA</option>
                                <option value="1522">RESIDENCIAL INTERLOMAS</option>
                                <option value="2101">RESIDENCIAL LOS CISNES</option>
                                <option value="1523">RESIDENCIAL PALMILLAS</option>
                                <option value="1525">RESIDENCIAL PRADOS</option>
                                <option value="1526">RESIDENCIAL PRIVANZAS</option>
                                <option value="1527">RESIDENCIAL VILLA BONITA</option>
                                <option value="1528">REVOLUCIÓN</option>
                                <option value="1531">RINCÓN DEL HUMAYA</option>
                                <option value="1532">RINCÓN DEL PARQUE</option>
                                <option value="1533">RINCÓN DEL VALLE</option>
                                <option value="1534">RINCÓN FELIZ</option>
                                <option value="1535">RINCÓN REAL</option>
                                <option value="1536">RINCÓN SAN RAFAEL</option>
                                <option value="1537">RINCÓN SANTA ROSA</option>
                                <option value="1529">RIVERAS DE TAMAZULA</option>
                                <option value="1540">RIVERAS DEL HUMAYA</option>
                                <option value="1542">ROSALES</option>
                                <option value="1544">ROSARIO UZARRAGA</option>
                                <option value="1545">ROSITA</option>
                                <option value="1547">ROTARISMO</option>
                                <option value="1549">RUIZ CORTINES</option>
                                <option value="1550">SALVADOR ALVARADO</option>
                                <option value="1551">SAN AGUSTÍN</option>
                                <option value="1552">SAN BENITO</option>
                                <option value="1553">SAN CARLOS</option>
                                <option value="1554">SAN CIPRIANO</option>
                                <option value="1555">SAN DIEGO</option>
                                <option value="1556">SAN FERNANDO</option>
                                <option value="1558">SAN FLORENCIO</option>
                                <option value="1559">SAN FLORENCIO II</option>
                                <option value="1560">SAN ISIDRO</option>
                                <option value="1561">SAN JUAN</option>
                                <option value="1563">SAN LUIS RESIDENCIAL</option>
                                <option value="1564">SAN RAFAEL</option>
                                <option value="1566">SAN VALENTINO</option>
                                <option value="1567">SANTA ANITA</option>
                                <option value="1568">SANTA AYNES</option>
                                <option value="1569">SANTA BÁRBARA</option>
                                <option value="1570">SANTA ELENA</option>
                                <option value="1572">SANTA FÉ</option>
                                <option value="1573">SANTA ROCÍO</option>
                                <option value="2118">SANTA ROSA</option>
                                <option value="1575">SANTA SUSANA</option>
                                <option value="1576">SANTA TERESA</option>
                                <option value="1578">SECCIÓN MAGISTERIO LAS QUINTAS</option>
                                <option value="1584">SERVIDORES PUBLICO</option>
                                <option value="1585">SIMÓN BOLÍVAR</option>
                                <option value="1586">SINALOA</option>
                                <option value="1587">SOLIDARIDAD</option>
                                <option value="2117">STANZA TORRALBA</option>
                                <option value="2116">STANZA TOSCANA</option>
                                <option value="1588">STASE</option>
                                <option value="1590">STASE II</option>
                                <option value="1591">TERRANOVA</option>
                                <option value="1594">TERRAZAS Y VILLAS DEL MANANTIAL</option>
                                <option value="1595">TIERRA BLANCA</option>
                                <option value="1596">TIERRA BLANCA ORIENTE</option>
                                <option value="1598">TORRES AEROPUERTO</option>
                                <option value="1600">TULIPANES</option>
                                <option value="1601">UAS</option>
                                <option value="1603">UNIVERSIDAD 94</option>
                                <option value="1604">UNIVERSIDAD 94 II</option>
                                <option value="1607">UNIVERSITARIOS</option>
                                <option value="1609">URBIQUINTA VERSALLES</option>
                                <option value="1610">URBIVILLA</option>
                                <option value="2093">URBIVILLA DEL CEDRO</option>
                                <option value="1611">URBIVILLA DEL ROBLE</option>
                                <option value="1613">URBIVILLA DEL SOL</option>
                                <option value="1617">VALENCIA</option>
                                <option value="1618">VALENTINO</option>
                                <option value="1620">VALLADO NUEVO</option>
                                <option value="1621">VALLADO VIEJO</option>
                                <option value="1622">VALLE ALTO</option>
                                <option value="1623">VALLE BONITO</option>
                                <option value="1624">VALLE DE LOS ARCOS</option>
                                <option value="1625">VALLE DEL RÍO</option>
                                <option value="1626">VALLE DORADO</option>
                                <option value="1627">VALLE REAL</option>
                                <option value="1628">VALLES DEL SOL</option>
                                <option value="1629">VALLES ESPAÑOLES</option>
                                <option value="1631">VELLEGAS AGUARUTO</option>
                                <option value="1633">VICENTE GUERRERO</option>
                                <option value="1637">VICENTE LOMBARDO TOLEDANO</option>
                                <option value="1641">VILLA BONITA</option>
                                <option value="1642">VILLA COLONIAL</option>
                                <option value="1643">VILLA CONTENTA</option>
                                <option value="1645">VILLA DEL HUMAYA</option>
                                <option value="1646">VILLA DEL REAL</option>
                                <option value="1647">VILLA DORADA</option>
                                <option value="1648">VILLA FONTANA</option>
                                <option value="1649">VILLA REAL</option>
                                <option value="1650">VILLA SANTA ANITA</option>
                                <option value="1651">VILLA SATÉLITE</option>
                                <option value="1652">VILLA UNIVERSIDAD</option>
                                <option value="1653">VILLA VERDE</option>
                                <option value="1656">VILLAS DE SANTA ANITA</option>
                                <option value="1658">VILLAS DEL HUMAYA</option>
                                <option value="1659">VILLAS DEL MANANTIAL</option>
                                <option value="1660">VILLAS DEL RÍO</option>
                                <option value="1662">VILLAS DEL SOL</option>
                                <option value="1663">VILLAS SAN ANTONIO</option>
                                <option value="1664">VILLAS VICTORIA</option>
                                <option value="1667">VILLEGAS AGUARUTO</option>
                                <option value="1669">VINORAMAS</option>
                                <option value="1671">VISTA HERMOSA</option>
                                <option value="1672">ZAPATA</option>
                                <option value="1673">ZONA CENTRO</option>
                                <option value="1778">CENTRO</option>
                                <option value="1779">CULIACANCITO</option>
                                <option value="1780">LAS PALMAS</option>
                                <option value="1782">LOS BASILITOS</option>
                                <option value="2031">CANAN</option>
                                <option value="2051">BARRANCOS</option>
                                <option value="2052">EL DIEZ</option>
                                <option value="1954">EL DIEZ</option>
                                <option value="1955">EL QUEMADITO</option>
                                <option value="1958">PREDIO SAN RAFAEL</option>
                                <option value="1950">LOCALIDAD EJIDO EL 15</option>
                                <option value="1974">LA ARROCERA</option>
                                <option value="1975">LA BEBELAMA</option>
                                <option value="1976">SAN DIEGO</option>
                                <option value="2056">CAMPO EL DIEZ</option>
                                <option value="2057">EJIDO LAS FLORES</option>
                                <option value="2063">PARQUE INDUSTRIAL EL TRÉBOL</option>
                                <option value="2064">RINCÓN DEL VALLE</option>
                                <option value="1685">LOS BECOS</option>
                                <option value="1948">LOS HUIZACHES</option>
                                <option value="1883">MEZQUITILLO</option>
                                <option value="1927">SAN JOAQUÍN</option>
                                <option value="2078">SECCIÓN ALHUATE</option>
                                <option value="1984">EL ALTO DE OSO</option>
                                <option value="1693">EL CONCHAL</option>
                                <option value="1695">SOYATITA</option>
                                <option value="1989">CAMPO EL 10</option>
                                <option value="1997">PIGGY BACK</option>
                                <option value="1847">EL HIGUERAL</option>
                                <option value="1869">EL COCHI</option>
                                <option value="1865">EL LIMÓN DE LOS RAMOS</option>
                                <option value="1870">LIMÓNES</option>
                                <option value="1873">SECTOR PENITAS</option>
                                <option value="1875">SECTOR RIELES</option>
                                <option value="1876">VENADILLO</option>
                                <option value="2068">LOCALIDAD EL QUEMADITO</option>
                                <option value="2071">AMPLIACIÓN EL RANCHITO</option>
                                <option value="2017">BARRANCOS</option>
                                <option value="2072">CAMPO EL DIEZ</option>
                                <option value="2073">COLONIA JESÚS MANUEL CAMEZ VALDEZ</option>
                                <option value="2018">EL RANCHITO</option>
                                <option value="2074">EL RANCHITO</option>
                                <option value="2075">EL RANCHITO 2</option>
                                <option value="2076">LA COSTERITA</option>
                                <option value="2085">EL RANCHITO SAN NICOLÁS</option>
                                <option value="1968">EL ROBALAR</option>
                                <option value="2041">LA PRESITA</option>
                                <option value="1923">EL SALADO</option>
                                <option value="1787">ALEJANDRO REDO</option>
                                <option value="1789">AMPLIACIÓN BENITO JUÁREZ</option>
                                <option value="1790">AMPLIACIÓN NAVITO</option>
                                <option value="1791">ARBOLEDAS</option>
                                <option value="1792">ARGENTINA</option>
                                <option value="1793">ARROLLITO</option>
                                <option value="1794">AVIACIÓN</option>
                                <option value="1795">BUENOS AIRES</option>
                                <option value="1796">CAMPO EL 6</option>
                                <option value="1797">CAMPO REBECA 1</option>
                                <option value="1798">CAMPO REBECA 2</option>
                                <option value="1799">CENTRO</option>
                                <option value="1802">CUCHILLA</option>
                                <option value="1807">ESCOBED0</option>
                                <option value="1809">FIDEL VELÁZQUEZ</option>
                                <option value="1815">INFONAVIT SAN DIEGO</option>
                                <option value="1816">INFONAVIT VILLA DORADA</option>
                                <option value="1821">LA HUERTA DE REDO</option>
                                <option value="1825">LA HUERTITA DE SERRANO</option>
                                <option value="1827">LAS PALMAS</option>
                                <option value="1828">LÁZARO CÁRDENAS</option>
                                <option value="1829">LOMAS DEL PEDREGAL</option>
                                <option value="1830">LOS CUARTOS</option>
                                <option value="1831">NAKAYAMA</option>
                                <option value="1833">NUEVA AMPLIACIÓN DE NAVITO</option>
                                <option value="1834">OBRERA</option>
                                <option value="1839">RUIZ CORTINES</option>
                                <option value="1840">SAN JUAN</option>
                                <option value="1841">SAN LORENZO</option>
                                <option value="1842">VILLA DORADA</option>
                                <option value="1999">ESTACIÓN OBISPO</option>
                                <option value="2004">PENÍNSULA DE VILLAMOROS</option>
                                <option value="2005">SINDICATURA EMILIANO ZAPATA</option>
                                <option value="2006">SINDICATURA HIGUERAS DE ABUYA</option>
                                <option value="2008">ESTACIÓN VITARUTO</option>
                                <option value="2113">SINDICATURA DE IMALA</option>
                                <option value="1846">JACOLA</option>
                                <option value="1856">JESÚS MARÍA</option>
                                <option value="1679">LA ANONA DE JESÚS MARÍA</option>
                                <option value="2050">LA COHETERIA</option>
                                <option value="1690">CAMPO LA HUAJIRA</option>
                                <option value="1691">CANAN</option>
                                <option value="2030">CAMPO LA OBEJA NEGRA</option>
                                <option value="1949">LA PIEDRA</option>
                                <option value="2065">CAMPO FLORENCIA</option>
                                <option value="2090">LA PILDORA</option>
                                <option value="2015">LOCALIDAD LA PITAHAYITA</option>
                                <option value="2016">LOMAS DE RODRIGUERA</option>
                                <option value="2021">CULIACANCITO</option>
                                <option value="2022">POBLADO LA PLATANERA</option>
                                <option value="2066">LOCALIDAD LA PRESITA</option>
                                <option value="2067">SAN AGUSTÍN LA PRIMAVERA</option>
                                <option value="1929">LA 20</option>
                                <option value="1857">LAGUNA COLORADA</option>
                                <option value="1858">LAGUNA DE CANACHI</option>
                                <option value="1680">LAS ARENITAS</option>
                                <option value="1681">QUINTO PATIO</option>
                                <option value="1684">LAS BATEAS</option>
                                <option value="1861">LEOPOLDO SÁNCHEZ CELIS</option>
                                <option value="1952">LOS BECOS</option>
                                <option value="2080">CAMPO LOS CORRALES</option>
                                <option value="1882">LOS LLANOS</option>
                                <option value="1965">JACOLA</option>
                                <option value="1889">SINDICATURA QUILA</option>
                                <option value="2054">CAMPO PANTULE</option>
                                <option value="1986">EMPAQUE PARALELO 38</option>
                                <option value="1890">PENÍNSULA DE VILLAMOROS</option>
                                <option value="1895">EMILIANO ZAPATA</option>
                                <option value="1896">PORTACELI</option>
                                <option value="2029">POSTA ZOOTECNIA</option>
                                <option value="1960">GUZMÁN</option>
                                <option value="1978">CENTRO</option>
                                <option value="1981">PUEBLOS UNIDOS</option>
                                <option value="1982">SINDICATURA EMILIANO ZAPATA</option>
                                <option value="1898">AVIACIÓN</option>
                                <option value="1899">BALCONES DEL VALLE</option>
                                <option value="1901">BELLAVISTA</option>
                                <option value="1902">CANACO</option>
                                <option value="1903">CEDROS</option>
                                <option value="1904">CENTRO</option>
                                <option value="1905">DEL PANTEÓN</option>
                                <option value="1906">EL ALTO</option>
                                <option value="1907">EL RASTRO</option>
                                <option value="1908">EMILIANO ZAPATA</option>
                                <option value="1910">IGNACIO ALLENDE</option>
                                <option value="1911">INFONAVIT QUILA</option>
                                <option value="1913">LÁZARO CÁRDENAS</option>
                                <option value="1914">LOMAS DEL BOULEVARD</option>
                                <option value="1915">LOMBARDO TOLEDANO</option>
                                <option value="1916">LOS ARCOS</option>
                                <option value="1917">LOS GIRASOLES</option>
                                <option value="1918">NOGALITOS</option>
                                <option value="1921">SANTA MARÍA</option>
                                <option value="2044">LAGUNA DORADA</option>
                                <option value="2007">CAMPO SAN RAFAEL</option>
                                <option value="2084">CAMPO SANTA AURORA</option>
                                <option value="2087">CAMPO SANTA YUTSIRY</option>
                                <option value="2083">CAMPO SESION CASITAS</option>
                                <option value="2091">LAS TAPIAS</option>
                                <option value="2023">SOYATITA</option>
                                <option value="1961">SOYATITA CRUZ II</option>

                            </select>
                            @if($errors->has('neighborhood_id'))
                                @foreach($errors->get('neighborhood_id') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="location">Código Postal</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="Dirección" value="{{ old('postal_code') }}">
                            @if($errors->has('postal_code'))
                                @foreach($errors->get('postal_code') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="location">Calle</label>
                            <input type="text" class="form-control @error('street_name') is-invalid @enderror" id="street_name" name="street_name" placeholder="Dirección" value="{{ old('street_name') }}">
                            @if($errors->has('street_name'))
                                @foreach($errors->get('street_name') as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2-blue').select2();
        });
        // submit via XHRequest
{{--        $('#create_incident').submit(function(e) {--}}
{{--            e.preventDefault();--}}
{{--/*--}}
{{--            string  $service_id,--}}
{{--            string  $service_type,--}}
{{--            string  $report_message,--}}
{{--            string  $colonia,--}}
{{--            string  $street,--}}
{{--            ?string $postal_code--}}
{{-- */--}}
{{--            // declare the above variables--}}
{{--            let service_id = document.getElementById('service_type_id').value;--}}
{{--            let service_type = document.getElementById('service_type_id').value;--}}
{{--            let report_message = document.getElementById('report_message').value;--}}
{{--            let colonia = document.getElementById('neighborhood_id').value;--}}
{{--            let street = document.getElementById('street_name').value;--}}
{{--            let postal_code = document.getElementById('postal_code').value;--}}

{{--            console.log(service_id, service_type, report_message, colonia, street, postal_code);--}}

{{--            var myHeaders = new Headers();--}}
{{--            myHeaders.append("User-Agent", "Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0");--}}
{{--            myHeaders.append("Accept", "*/*");--}}
{{--            myHeaders.append("Accept-Language", "en-US,en;q=0.5");--}}
{{--            myHeaders.append("Accept-Encoding", "gzip, deflate, br");--}}
{{--            myHeaders.append("X-Requested-With", "XMLHttpRequest");--}}
{{--            myHeaders.append("Origin", "https://apps.culiacan.gob.mx");--}}
{{--            myHeaders.append("Connection", "keep-alive");--}}
{{--            myHeaders.append("Referer", "https://apps.culiacan.gob.mx/ciudadano/reportar");--}}
{{--            myHeaders.append("Cookie", "ventanillaactiva=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22fb8612789c72d17072d57c1eb6a1a6b0%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22187.145.104.196%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A70%3A%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%3B+rv%3A103.0%29+Gecko%2F20100101+Firefox%2F103.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1659067237%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7Df4526f4d061767aabe57960f1e16a918; _ga=GA1.3.505146067.1659060468; _gid=GA1.3.1622479335.1659060468");--}}
{{--            myHeaders.append("Sec-Fetch-Dest", "empty");--}}
{{--            myHeaders.append("Sec-Fetch-Mode", "cors");--}}
{{--            myHeaders.append("Sec-Fetch-Site", "same-origin");--}}
{{--            myHeaders.append("TE", "trailers");--}}

{{--            var formdata = new FormData();--}}
{{--            formdata.append("servicio", service_id);--}}
{{--            formdata.append("tipo_servicio", service_type);--}}
{{--            formdata.append("reporte", report_message);--}}
{{--            formdata.append("calle", street);--}}
{{--            formdata.append("numero", "0'0");--}}
{{--            formdata.append("id_colonia", colonia);--}}
{{--            formdata.append("codigo_postal", postal_code);--}}
{{--            formdata.append("nombreId", "');");--}}
{{--            formdata.append("nombre", "anonimo");--}}
{{--            formdata.append("domicilio", "");--}}
{{--            formdata.append("correo", "test@test.com");--}}
{{--            formdata.append("telefono", "6666666666");--}}
{{--            formdata.append("celular", "6666666666");--}}
{{--            formdata.append("nombreId", "");--}}
{{--            formdata.append("denuncia_nombre", "");--}}
{{--            formdata.append("denuncia_domicilio", "eee");--}}
{{--            formdata.append("denuncia_originario", "");--}}
{{--            formdata.append("denuncia_nacionalidad", "");--}}
{{--            formdata.append("denuncia_telefono", "");--}}
{{--            formdata.append("denuncia_escolaridad", "");--}}
{{--            formdata.append("denuncia_edad", "0");--}}
{{--            formdata.append("denuncia_sexo", "");--}}
{{--            formdata.append("denuncia_ocupacion", "");--}}
{{--            formdata.append("denuncia_estado_civil", "");--}}
{{--            formdata.append("denuncia_correo", "");--}}
{{--            formdata.append("denuncia_rfc", "");--}}
{{--            formdata.append("denunciado_nombre", "");--}}
{{--            formdata.append("denunciado_domicilio", "");--}}
{{--            formdata.append("denunciado_cargo", "");--}}
{{--            formdata.append("denunciado_razon_social", "");--}}
{{--            formdata.append("denuncia_hechos", "");--}}
{{--            formdata.append("denuncia_medios", "no");--}}
{{--            formdata.append("denuncia_publicas_url", "");--}}
{{--            formdata.append("denuncia_privadas_url", "");--}}
{{--            formdata.append("testigo_existe", "0");--}}
{{--            formdata.append("denuncia_informacion_url", "");--}}
{{--            formdata.append("denuncia_otros", "");--}}
{{--            formdata.append("latitud", "");--}}
{{--            formdata.append("longitud", "");--}}
{{--            formdata.append("testigo_nombre", "");--}}
{{--            formdata.append("testigo_domicilio", "");--}}
{{--            formdata.append("testigo_telefono", "");--}}

{{--            var requestOptions = {--}}
{{--                method: 'POST',--}}
{{--                headers: myHeaders,--}}
{{--                body: formdata,--}}
{{--                redirect: 'follow'--}}
{{--            };--}}
{{--            --}}{{--action="{{ route('incidents.store') }}"--}}
{{--            fetch("https://apps.culiacan.gob.mx/ciudadano/ciudadano/reportes/registrar_reporte", requestOptions)--}}
{{--                .then(response => response.text())--}}
{{--                .then(result => console.log(result))--}}
{{--                .catch(error => console.log('error', error));--}}
{{--        });--}}
    </script>
@stop
