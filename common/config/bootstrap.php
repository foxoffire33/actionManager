<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

// Aliases for the file uploads
Yii::setAlias('frontend_uploads', 'http://enhanced-front.nl/uploads/');
Yii::setAlias('frontend_uploads_dir', dirname(dirname(__DIR__)) . '/frontend/web/uploads/');
Yii::setAlias('backend_uploads', 'http://enhanced-back.nl/uploads/');
Yii::setAlias('backend_uploads_dir', dirname(dirname(__DIR__)) . '/backend/web/uploads/');