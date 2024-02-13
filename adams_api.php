<?php
if(isset($_POST['product_id'], $_POST['product_name'], $_POST['precio'], $_POST['image'])) {

    $idDeuda = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $precio = $_POST['precio'];
    $image = $_POST['image'];
    $siExiste = 'update';
    $apiUrl = 'https://staging.adamspay.com/api/v1/debts';
    $apiKey = 'ap-7f26f07abefa0c640dbaa6ed';

    $ahora = new DateTimeImmutable('now',new DateTimeZone('UTC'));
    $expira = $ahora->add(new DateInterval('P2D'));

    // Crear modelo de deuda
    $deuda = [
        'docId' => $idDeuda,
        'label' => $product_name,
        'amount' => ['currency' => 'PYG', 'value' => $precio],
        'validPeriod' => [
            'start' => $ahora->format(DateTime::ATOM),
            'end' => $expira->format(DateTime::ATOM)
        ]
    ];

    // Crear JSON para el post
    $post = json_encode(['debt' => $deuda]);

    $curl = curl_init();

    // Configurar opciones de cURL
    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_HTTPHEADER => ['apikey: ' . $apiKey, 'Content-Type: application/json', 'x-if-exists: ' . $siExiste],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post
    ]);

    $response = curl_exec($curl);

    if ($response) {
        $data = json_decode($response, true);

        $payUrl = isset($data['debt']) ? $data['debt']['payUrl'] : null;

        if ($payUrl) {
            $response = array('status' => 'success', 'message' => 'Deuda creada exitosamente', 'pay' => $payUrl);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'No se pudo crear la deuda.', 'pay' => $data['meta']);
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Error comuniquese con el desarrollador.', 'pay' => curl_error($curl));
        echo json_encode($response);
    }
    curl_close($curl);
}
?>