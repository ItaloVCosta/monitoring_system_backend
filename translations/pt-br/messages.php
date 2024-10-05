<?php

return [
    'error' => [
        'server' => 'Ocorreu um erro ao buscar os detalhes do servidor.',
        'general' => 'Ocorreu um erro inesperado.',
    ],
    'http' => [
        'error' =>[
            '404' => [
                'server' => 'Servidor não encontrado',
                'server_not_found' => 'O servidor com o id fornecido não existe',
                'route' => 'Rota não encontrada' 
            ],
            '405' => 'Método não permitido' 
        ],
        'success' => [
            'created' => [
                'server' => 'Servidor criado com sucesso',
            ],
            'updated' => [
                'server' => 'Servidor atualizado com sucesso',
            ],
            'deleted' => [
                'server' => 'Servidor deletado com sucesso',
            ]
        ]
    ]
];