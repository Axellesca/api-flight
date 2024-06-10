<?php
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;
  require 'vendor/autoload.php';

  Flight::register('db','PDO',array('mysql:host=localhost:3307;dbname=sistema2','root',''));
  
  // Flight::register('db','mysqli',array('localhost:3307','root','','sistema2'));//Usando MySQLI

  Flight::route('/', function(){
    // Usando MYSQLI PRUEBA
    // $db = Flight::db();
    // $query = $db->query('SELECT * FROM usuarios');
    // $datos = $query->fetch_all(MYSQLI_ASSOC);
    // echo json_encode($datos);
    $array = [
      "texto" => "Hello World",
      "status" => 'Success'
    ];
    echo json_encode($array);
  });

  Flight::route('GET /users', function(){
    $db = Flight::db();
    $query = $db->query('SELECT * FROM usuarios');
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    // $data = $query->fetch_assoc();

    // print_r($data);

    $array = [];
    // foreach($data as $row){
    //   $array[] = $row;
    // }

    foreach($data as $row){
      $array[] = [
        'id' => $row['id'],
        'usuario' => $row['usuario'],
        'password' => $row['password'],
        'dni' => $row['dni'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'email' => $row['email'],
        'id_rol' => $row['id_rol'],
      ];
    }
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );

    
  });

  Flight::route('GET /beneficios', function(){
    $db = Flight::db();
    $query = $db->query('SELECT p.id as id_pers,p.cuil,p.doc_nro , p.doc_tipo , p.id_sexo , p.apellido , p.nombres , p.nacimiento_f , p.fallecimiento_f, p.email, p.telefono, p.estado_civil, p.dom_calle, p.dom_nro, p.dom_piso, p.dom_dpto, p.id_codpostal, p.porc_discap, p.exagente, p.id_estado, b.id as id_benef,b.id_persona, b.clase_ben, b.subclase_ben, b.numero_ben, b.digito_ben, b.escalafon, b.subescalafon, b.ordenanza, b.id_tipo_ben, b.antiguedad, b.categoria, b.titulo,b.serv_sim, b.id_nro_exp, b.id_resol, b.cese_f, b.vigencia_f, b.inclusion_f, b.baja_f, b.porc_pago, b.porc_jub, b.porc_pens, b.porc_os, b.suc_bcria, b.cta_bcria, b.cbu, b.id_pers_deriva, b.nro_exp, b.nro_res, b.id_estado as estado_benef 
    FROM beneficios b 
    INNER JOIN personas p on b.id_persona = p.id
    WHERE b.id_estado != 2
    ORDER BY b.clase_ben ASC, b.subclase_ben ASC, b.numero_ben ASC, b.digito_ben ASC');
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    // print_r($data);

    $array = [];
    // foreach($data as $row){
    //   $array[] = $row;
    // }

    foreach($data as $row){
      $array[] = [
        'id_p' => $row['id_pers'],
        'cuil' => $row['cuil'],
        'doc_nro' => $row['doc_nro'],
        'doc_tipo' => $row['doc_tipo'],
        'id_sexo' => $row['id_sexo'],
        'apellido' => $row['apellido'],
        'nombres' => $row['nombres'],
        'nacimiento_f' => $row['nacimiento_f'],
        'fallecimiento_f' => $row['fallecimiento_f'],
        'email' => $row['email'],
        'telefono' => $row['telefono'],
        'estado_civil' => $row['estado_civil'],
        'dom_calle' => $row['dom_calle'],
        'dom_nro' => $row['dom_nro'],
        'dom_piso' => $row['dom_piso'],
        'dom_dpto' => $row['dom_dpto'],
        'id_codpostal' => $row['id_codpostal'],
        'porc_discap' => $row['porc_discap'],
        'exagente' => $row['exagente'],
        'id_estado' => $row['id_estado'],
        'id_b' => $row['id_benef'],
        'id_persona' => $row['id_persona'],
        'clase_ben' => $row['clase_ben'],
        'subclase_ben' => $row['subclase_ben'],
        'numero_ben' => $row['numero_ben'],
        'digito_ben' => $row['digito_ben'],
        'escalafon' => $row['escalafon'],
        'subescalafon' => $row['subescalafon'],
        'ordenanza' => $row['ordenanza'],
        'id_tipo_ben' => $row['id_tipo_ben'],
        'antiguedad' => $row['antiguedad'],
        'categoria' => $row['categoria'],
        'titulo' => $row['titulo'],
        'serv_sim' => $row['serv_sim'],
        'id_nro_exp' => $row['id_nro_exp'],
        'id_resol' => $row['id_resol'],
        'cese_f' => $row['cese_f'],
        'vigencia_f' => $row['vigencia_f'],
        'inclusion_f' => $row['inclusion_f'],
        'baja_f' => $row['baja_f'],
        'porc_pago' => $row['porc_pago'],
        'porc_jub' => $row['porc_jub'],
        'porc_pens' => $row['porc_pens'],
        'porc_os' => $row['porc_os'],
        'suc_bcria' => $row['suc_bcria'],
        'cta_bcria' => $row['cta_bcria'],
        'cbu' => $row['cbu'],
        'id_pers_deriva' => $row['id_pers_deriva'],
        'nro_exp' => $row['nro_exp'],
        'nro_res' => $row['nro_res'],
        'estado_benef' => $row['estado_benef'],
      ];
    }
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );

    
  });

  Flight::route('GET /users/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare('SELECT * FROM usuarios WHERE id = :id');
    $query->execute([
      'id' => $id
    ]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($data);

    $array = [
      'id' => $data['id'],
      'usuario' => $data['usuario'],
      'password' => $data['password'],
      'dni' => $data['dni'],
      'nombre' => $data['nombre'],
      'apellido' => $data['apellido'],
      'email' => $data['email'],
      'id_rol' => $data['id_rol'],
    ];
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );
  });

  Flight::route('POST /users', function(){
    $db = Flight::db();
    $query = $db->prepare('INSERT INTO usuarios (usuario, password, dni, nombre, apellido, email, id_rol) VALUES (:usuario, :password, :dni, :nombre, :apellido, :email, :id_rol)');
    $query->execute([
      'usuario' => Flight::request()->data->usuario,
      'password' => Flight::request()->data->password,
      'dni' => Flight::request()->data->dni,
      'nombre' => Flight::request()->data->nombre,
      'apellido' => Flight::request()->data->apellido,
      'email' => Flight::request()->data->email,
      'id_rol' => Flight::request()->data->id_rol,
    ]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($data);

    $array = [
      'id' => $db->lastInsertId(),
      'usuario' => Flight::request()->data->usuario,
      'password' => Flight::request()->data->password,
      'dni' => Flight::request()->data->dni,
      'nombre' => Flight::request()->data->nombre,
      'apellido' => Flight::request()->data->apellido,
      'email' => Flight::request()->data->email,
      'id_rol' => Flight::request()->data->id_rol,
    ];
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );
  });

  Flight::route('POST /auth', function(){
    $db = Flight::db();

    $now = strtotime('now');
    $key = 'example_key';
    $payload = [
        'exp' => $now + 3600,
        'data' => [
          'id' => 1,
          'usuario' => 'admin',
          'password' => 'admin',
          'dni' => '12345678',
          'nombre' => 'Admin',
          'apellido' => 'Admin',
          'email' => ''
        ]
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    print_r($jwt);
  });

  Flight::route('PUT /users/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare('UPDATE usuarios SET usuario = :usuario, password = :password, dni = :dni, nombre = :nombre, apellido = :apellido, email = :email, id_rol = :id_rol WHERE id = :id');
    $query->execute([
      'id' => $id,
      'usuario' => Flight::request()->data->usuario,
      'password' => Flight::request()->data->password,
      'dni' => Flight::request()->data->dni,
      'nombre' => Flight::request()->data->nombre,
      'apellido' => Flight::request()->data->apellido,
      'email' => Flight::request()->data->email,
      'id_rol' => Flight::request()->data->id_rol,
    ]);
    // $data = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($data);

    $array = [
      'id' => $id,
      'usuario' => Flight::request()->data->usuario,
      'password' => Flight::request()->data->password,
      'dni' => Flight::request()->data->dni,
      'nombre' => Flight::request()->data->nombre,
      'apellido' => Flight::request()->data->apellido,
      'email' => Flight::request()->data->email,
      'id_rol' => Flight::request()->data->id_rol,
    ];
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );
  });
  
  Flight::route('DELETE /users/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare('DELETE FROM usuarios WHERE id = :id');
    $query->execute([
      'id' => $id
    ]);
    // $data = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($data);

    $array = [
      'id' => $id,
    ];
    // echo json_encode($array);

    Flight::json(
      [
        "total_rows" => $query->rowCount(),
        "data" => $array
      ]
    );
  });

  Flight::start();
?>