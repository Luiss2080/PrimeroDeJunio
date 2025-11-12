<?php

/**
 * Vista Crear Vehículo - Sistema PRIMERO DE JUNIO
 */

$title = 'Nuevo Vehículo';
$current_page = 'vehiculos';

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Registrar Nuevo Vehículo</span>
                        <span class="title-subtitle">Agregar vehículo a la flota de transporte</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/vehiculos" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Container -->
<div class="container-modern">
    <!-- Progress Indicator -->
    <div class="progress-indicator-modern" data-aos="fade-up">
        <div class="progress-steps-modern">
            <div class="progress-step-modern active" data-step="1">
                <div class="step-number-modern">1</div>
                <div class="step-label-modern">Información Básica</div>
            </div>
            <div class="progress-line-modern"></div>
            <div class="progress-step-modern" data-step="2">
                <div class="step-number-modern">2</div>
                <div class="step-label-modern">Especificaciones</div>
            </div>
            <div class="progress-line-modern"></div>
            <div class="progress-step-modern" data-step="3">
                <div class="step-number-modern">3</div>
                <div class="step-label-modern">Documentación</div>
            </div>
            <div class="progress-line-modern"></div>
            <div class="progress-step-modern" data-step="4">
                <div class="step-number-modern">4</div>
                <div class="step-label-modern">Configuraciones</div>
            </div>
        </div>
    </div>

    <form class="form-modern" id="formVehiculo" method="POST" action="/admin/vehiculos/crear" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
        <!-- Paso 1: Información Básica -->
        <div class="form-step-modern active" data-step="1">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <span>Información Básica del Vehículo</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <!-- Photo Upload -->
                        <div class="form-group-modern full-width">
                            <div class="vehicle-upload-modern">
                                <div class="vehicle-preview-modern">
                                    <img id="vehiclePreview" src="/assets/images/default-vehicle.png" alt="Vehículo">
                                </div>
                                <div class="upload-button-modern">
                                    <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                                    <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('foto').click()">
                                        <span class="btn-icon"><i class="fas fa-camera"></i></span>
                                        <span class="btn-text">Subir Foto</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">Placa</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern plate-input"
                                        name="placa"
                                        id="placa"
                                        value="<?= htmlspecialchars($old['placa'] ?? '') ?>"
                                        placeholder="ABC-1234"
                                        style="text-transform: uppercase;"
                                        required>
                                </div>
                                <div class="form-error-modern" id="error-placa"></div>
                                <div class="form-help-modern">Formato: ABC-1234 o 1234-ABC</div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">Marca</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-industry"></i>
                                    </div>
                                    <select class="form-select-modern" name="marca" id="marca" required>
                                        <option value="">Seleccionar marca</option>
                                        <option value="Toyota" <?= ($old['marca'] ?? '') === 'Toyota' ? 'selected' : '' ?>>Toyota</option>
                                        <option value="Nissan" <?= ($old['marca'] ?? '') === 'Nissan' ? 'selected' : '' ?>>Nissan</option>
                                        <option value="Hyundai" <?= ($old['marca'] ?? '') === 'Hyundai' ? 'selected' : '' ?>>Hyundai</option>
                                        <option value="Chevrolet" <?= ($old['marca'] ?? '') === 'Chevrolet' ? 'selected' : '' ?>>Chevrolet</option>
                                        <option value="Suzuki" <?= ($old['marca'] ?? '') === 'Suzuki' ? 'selected' : '' ?>>Suzuki</option>
                                        <option value="Ford" <?= ($old['marca'] ?? '') === 'Ford' ? 'selected' : '' ?>>Ford</option>
                                        <option value="Volkswagen" <?= ($old['marca'] ?? '') === 'Volkswagen' ? 'selected' : '' ?>>Volkswagen</option>
                                        <option value="Kia" <?= ($old['marca'] ?? '') === 'Kia' ? 'selected' : '' ?>>Kia</option>
                                        <option value="Mazda" <?= ($old['marca'] ?? '') === 'Mazda' ? 'selected' : '' ?>>Mazda</option>
                                        <option value="Honda" <?= ($old['marca'] ?? '') === 'Honda' ? 'selected' : '' ?>>Honda</option>
                                        <option value="Otra" <?= ($old['marca'] ?? '') === 'Otra' ? 'selected' : '' ?>>Otra</option>
                                    </select>
                                </div>
                                <div class="form-error-modern" id="error-marca"></div>
                            </div>

                            <div class="form-group-modern" id="otra-marca" style="display: none;">
                                <label class="form-label-modern">Especificar Marca</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="marca_otra"
                                        id="marca_otra"
                                        value="<?= htmlspecialchars($old['marca_otra'] ?? '') ?>"
                                        placeholder="Ingrese la marca">
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">Modelo</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-car-side"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="modelo"
                                        id="modelo"
                                        value="<?= htmlspecialchars($old['modelo'] ?? '') ?>"
                                        placeholder="Ej: Corolla, Sentra, Accent..."
                                        required>
                                </div>
                                <div class="form-error-modern" id="error-modelo"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">Año</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <select class="form-select-modern" name="anio" id="anio" required>
                                        <option value="">Seleccionar año</option>
                                        <?php
                                        $currentYear = date('Y');
                                        $startYear = 1990;
                                        for ($year = $currentYear + 1; $year >= $startYear; $year--) {
                                            $selected = ($old['anio'] ?? '') == $year ? 'selected' : '';
                                            echo "<option value=\"$year\" $selected>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-error-modern" id="error-anio"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">Color</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="color"
                                        id="color"
                                        value="<?= htmlspecialchars($old['color'] ?? '') ?>"
                                        placeholder="Ej: Blanco, Azul, Rojo..."
                                        required>
                                </div>
                                <div class="form-error-modern" id="error-color"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">Tipo de Vehículo</label>
                                <div class="radio-group-modern vehicle-types">
                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="tipo"
                                            value="sedan"
                                            <?= ($old['tipo'] ?? 'sedan') === 'sedan' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-car"></i>
                                            <span>Sedán</span>
                                        </div>
                                    </label>

                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="tipo"
                                            value="suv"
                                            <?= ($old['tipo'] ?? '') === 'suv' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-truck"></i>
                                            <span>SUV</span>
                                        </div>
                                    </label>

                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="tipo"
                                            value="hatchback"
                                            <?= ($old['tipo'] ?? '') === 'hatchback' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-car-side"></i>
                                            <span>Hatchback</span>
                                        </div>
                                    </label>

                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="tipo"
                                            value="pickup"
                                            <?= ($old['tipo'] ?? '') === 'pickup' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-truck-pickup"></i>
                                            <span>Pick-up</span>
                                        </div>
                                    </label>

                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="tipo"
                                            value="van"
                                            <?= ($old['tipo'] ?? '') === 'van' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-shuttle-van"></i>
                                            <span>Van</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-error-modern" id="error-tipo"></div>
                            </div>
                        </div>

                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-primary btn-next" data-next="2">
                                <span class="btn-text">Siguiente</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Paso 2: Especificaciones -->
        <div class="form-step-modern" data-step="2">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <span>Especificaciones Técnicas</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label class="form-label-modern">Número de Motor</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="numero_motor"
                                        id="numero_motor"
                                        value="<?= htmlspecialchars($old['numero_motor'] ?? '') ?>"
                                        placeholder="Número del motor">
                                </div>
                                <div class="form-error-modern" id="error-numero_motor"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Número de Chasis</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-hashtag"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="numero_chasis"
                                        id="numero_chasis"
                                        value="<?= htmlspecialchars($old['numero_chasis'] ?? '') ?>"
                                        placeholder="Número de chasis (VIN)">
                                </div>
                                <div class="form-error-modern" id="error-numero_chasis"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Capacidad de Pasajeros</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <select class="form-select-modern" name="capacidad_pasajeros" id="capacidad_pasajeros">
                                        <option value="">Seleccionar capacidad</option>
                                        <option value="4" <?= ($old['capacidad_pasajeros'] ?? '') === '4' ? 'selected' : '' ?>>4 pasajeros</option>
                                        <option value="5" <?= ($old['capacidad_pasajeros'] ?? '5') === '5' ? 'selected' : '' ?>>5 pasajeros</option>
                                        <option value="6" <?= ($old['capacidad_pasajeros'] ?? '') === '6' ? 'selected' : '' ?>>6 pasajeros</option>
                                        <option value="7" <?= ($old['capacidad_pasajeros'] ?? '') === '7' ? 'selected' : '' ?>>7 pasajeros</option>
                                        <option value="8" <?= ($old['capacidad_pasajeros'] ?? '') === '8' ? 'selected' : '' ?>>8 pasajeros</option>
                                        <option value="9" <?= ($old['capacidad_pasajeros'] ?? '') === '9' ? 'selected' : '' ?>>9+ pasajeros</option>
                                    </select>
                                </div>
                                <div class="form-error-modern" id="error-capacidad_pasajeros"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Tipo de Combustible</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-gas-pump"></i>
                                    </div>
                                    <select class="form-select-modern" name="tipo_combustible" id="tipo_combustible">
                                        <option value="">Seleccionar combustible</option>
                                        <option value="gasolina" <?= ($old['tipo_combustible'] ?? 'gasolina') === 'gasolina' ? 'selected' : '' ?>>Gasolina</option>
                                        <option value="diesel" <?= ($old['tipo_combustible'] ?? '') === 'diesel' ? 'selected' : '' ?>>Diésel</option>
                                        <option value="gnv" <?= ($old['tipo_combustible'] ?? '') === 'gnv' ? 'selected' : '' ?>>GNV (Gas Natural)</option>
                                        <option value="glp" <?= ($old['tipo_combustible'] ?? '') === 'glp' ? 'selected' : '' ?>>GLP (Gas Licuado)</option>
                                        <option value="hibrido" <?= ($old['tipo_combustible'] ?? '') === 'hibrido' ? 'selected' : '' ?>>Híbrido</option>
                                        <option value="electrico" <?= ($old['tipo_combustible'] ?? '') === 'electrico' ? 'selected' : '' ?>>Eléctrico</option>
                                    </select>
                                </div>
                                <div class="form-error-modern" id="error-tipo_combustible"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Transmisión</label>
                                <div class="radio-group-modern transmission-types">
                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="transmision"
                                            value="manual"
                                            <?= ($old['transmision'] ?? 'manual') === 'manual' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-cogs"></i>
                                            <span>Manual</span>
                                        </div>
                                    </label>

                                    <label class="radio-modern">
                                        <input type="radio"
                                            name="transmision"
                                            value="automatica"
                                            <?= ($old['transmision'] ?? '') === 'automatica' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-magic"></i>
                                            <span>Automática</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-error-modern" id="error-transmision"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Kilometraje Actual</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    <input type="number"
                                        class="form-input-modern"
                                        name="kilometraje"
                                        id="kilometraje"
                                        value="<?= htmlspecialchars($old['kilometraje'] ?? '0') ?>"
                                        min="0"
                                        placeholder="0">
                                    <div class="input-suffix-modern">km</div>
                                </div>
                                <div class="form-error-modern" id="error-kilometraje"></div>
                            </div>
                        </div>

                        <!-- Características Adicionales -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-plus-circle"></i>
                                Características Adicionales
                            </h3>

                            <div class="checkbox-grid-modern">
                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="aire_acondicionado"
                                        <?= in_array('aire_acondicionado', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fas fa-snowflake"></i>
                                        <span>Aire Acondicionado</span>
                                    </div>
                                </label>

                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="gps"
                                        <?= in_array('gps', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fas fa-map-marked-alt"></i>
                                        <span>GPS</span>
                                    </div>
                                </label>

                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="bluetooth"
                                        <?= in_array('bluetooth', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fab fa-bluetooth"></i>
                                        <span>Bluetooth</span>
                                    </div>
                                </label>

                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="usb"
                                        <?= in_array('usb', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fab fa-usb"></i>
                                        <span>Puerto USB</span>
                                    </div>
                                </label>

                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="wifi"
                                        <?= in_array('wifi', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fas fa-wifi"></i>
                                        <span>WiFi</span>
                                    </div>
                                </label>

                                <label class="checkbox-modern">
                                    <input type="checkbox"
                                        name="caracteristicas[]"
                                        value="camara_retroceso"
                                        <?= in_array('camara_retroceso', $old['caracteristicas'] ?? []) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <i class="fas fa-video"></i>
                                        <span>Cámara de Retroceso</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-outline btn-back" data-back="1">
                                <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                                <span class="btn-text">Anterior</span>
                            </button>
                            <button type="button" class="btn-modern btn-primary btn-next" data-next="3">
                                <span class="btn-text">Siguiente</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Paso 3: Documentación -->
        <div class="form-step-modern" data-step="3">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <span>Documentación Legal</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label class="form-label-modern">RUAT (Registro)</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="ruat"
                                        id="ruat"
                                        value="<?= htmlspecialchars($old['ruat'] ?? '') ?>"
                                        placeholder="Número RUAT">
                                </div>
                                <div class="form-error-modern" id="error-ruat"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Fecha de Vencimiento RUAT</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <input type="date"
                                        class="form-input-modern"
                                        name="fecha_vencimiento_ruat"
                                        id="fecha_vencimiento_ruat"
                                        value="<?= htmlspecialchars($old['fecha_vencimiento_ruat'] ?? '') ?>">
                                </div>
                                <div class="form-error-modern" id="error-fecha_vencimiento_ruat"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">SOAT (Seguro)</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="soat"
                                        id="soat"
                                        value="<?= htmlspecialchars($old['soat'] ?? '') ?>"
                                        placeholder="Número SOAT">
                                </div>
                                <div class="form-error-modern" id="error-soat"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Fecha de Vencimiento SOAT</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <input type="date"
                                        class="form-input-modern"
                                        name="fecha_vencimiento_soat"
                                        id="fecha_vencimiento_soat"
                                        value="<?= htmlspecialchars($old['fecha_vencimiento_soat'] ?? '') ?>">
                                </div>
                                <div class="form-error-modern" id="error-fecha_vencimiento_soat"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Revisión Técnica</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <input type="text"
                                        class="form-input-modern"
                                        name="revision_tecnica"
                                        id="revision_tecnica"
                                        value="<?= htmlspecialchars($old['revision_tecnica'] ?? '') ?>"
                                        placeholder="Número de revisión técnica">
                                </div>
                                <div class="form-error-modern" id="error-revision_tecnica"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">Fecha de Vencimiento R.T.</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <input type="date"
                                        class="form-input-modern"
                                        name="fecha_vencimiento_revision"
                                        id="fecha_vencimiento_revision"
                                        value="<?= htmlspecialchars($old['fecha_vencimiento_revision'] ?? '') ?>">
                                </div>
                                <div class="form-error-modern" id="error-fecha_vencimiento_revision"></div>
                            </div>
                        </div>

                        <!-- Documentos Digitales -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Documentos Digitales
                            </h3>

                            <div class="documents-upload-modern">
                                <div class="document-item-modern">
                                    <label class="form-label-modern">RUAT Digital</label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="archivo_ruat" name="archivo_ruat" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                        <button type="button" class="btn-modern btn-outline btn-sm" onclick="document.getElementById('archivo_ruat').click()">
                                            <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                            <span class="btn-text">Subir RUAT</span>
                                        </button>
                                        <span class="file-name" id="archivo_ruat_name"></span>
                                    </div>
                                </div>

                                <div class="document-item-modern">
                                    <label class="form-label-modern">SOAT Digital</label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="archivo_soat" name="archivo_soat" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                        <button type="button" class="btn-modern btn-outline btn-sm" onclick="document.getElementById('archivo_soat').click()">
                                            <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                            <span class="btn-text">Subir SOAT</span>
                                        </button>
                                        <span class="file-name" id="archivo_soat_name"></span>
                                    </div>
                                </div>

                                <div class="document-item-modern">
                                    <label class="form-label-modern">Revisión Técnica Digital</label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="archivo_revision" name="archivo_revision" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                        <button type="button" class="btn-modern btn-outline btn-sm" onclick="document.getElementById('archivo_revision').click()">
                                            <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                            <span class="btn-text">Subir R.T.</span>
                                        </button>
                                        <span class="file-name" id="archivo_revision_name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-outline btn-back" data-back="2">
                                <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                                <span class="btn-text">Anterior</span>
                            </button>
                            <button type="button" class="btn-modern btn-primary btn-next" data-next="4">
                                <span class="btn-text">Siguiente</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Paso 4: Configuraciones -->
        <div class="form-step-modern" data-step="4">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span>Configuraciones y Estado</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <!-- Estado y Asignación -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-info-circle"></i>
                                Estado y Disponibilidad
                            </h3>

                            <div class="form-grid-modern">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Estado Inicial</label>
                                    <select class="form-select-modern" name="estado" id="estado">
                                        <option value="disponible" <?= ($old['estado'] ?? 'disponible') === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                        <option value="mantenimiento" <?= ($old['estado'] ?? '') === 'mantenimiento' ? 'selected' : '' ?>>En Mantenimiento</option>
                                        <option value="inactivo" <?= ($old['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                    </select>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Conductor Asignado</label>
                                    <select class="form-select-modern" name="conductor_id" id="conductor_id">
                                        <option value="">Sin asignar</option>
                                        <?php foreach ($conductores ?? [] as $conductor): ?>
                                            <option value="<?= $conductor['id'] ?>" <?= ($old['conductor_id'] ?? '') == $conductor['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?>
                                                <?php if (!empty($conductor['licencia'])): ?>
                                                    (Licencia: <?= htmlspecialchars($conductor['licencia']) ?>)
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Mantenimiento -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-tools"></i>
                                Programación de Mantenimiento
                            </h3>

                            <div class="form-grid-modern">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Próximo Mantenimiento</label>
                                    <div class="input-group-modern">
                                        <div class="input-icon-modern">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <input type="date"
                                            class="form-input-modern"
                                            name="proximo_mantenimiento"
                                            id="proximo_mantenimiento"
                                            value="<?= htmlspecialchars($old['proximo_mantenimiento'] ?? '') ?>">
                                    </div>
                                    <div class="form-help-modern">Fecha recomendada para el próximo mantenimiento</div>
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern">Km para Mantenimiento</label>
                                    <div class="input-group-modern">
                                        <div class="input-icon-modern">
                                            <i class="fas fa-tachometer-alt"></i>
                                        </div>
                                        <input type="number"
                                            class="form-input-modern"
                                            name="km_proximo_mantenimiento"
                                            id="km_proximo_mantenimiento"
                                            value="<?= htmlspecialchars($old['km_proximo_mantenimiento'] ?? '') ?>"
                                            placeholder="0">
                                        <div class="input-suffix-modern">km</div>
                                    </div>
                                    <div class="form-help-modern">Kilometraje aproximado para el mantenimiento</div>
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-comment-alt"></i>
                                Información Adicional
                            </h3>

                            <div class="form-group-modern full-width">
                                <label class="form-label-modern">Observaciones</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-comment-dots"></i>
                                    </div>
                                    <textarea class="form-textarea-modern"
                                        name="observaciones"
                                        id="observaciones"
                                        rows="4"
                                        placeholder="Notas importantes sobre el vehículo, condiciones especiales, historial de reparaciones, etc."><?= htmlspecialchars($old['observaciones'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-outline btn-back" data-back="3">
                                <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                                <span class="btn-text">Anterior</span>
                            </button>
                            <button type="submit" class="btn-modern btn-success btn-submit" id="submitBtn">
                                <span class="btn-icon"><i class="fas fa-save"></i></span>
                                <span class="btn-text">Registrar Vehículo</span>
                                <div class="btn-loading">
                                    <div class="spinner-modern"></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true
            });
        }

        // Referencias a elementos
        const form = document.getElementById('formVehiculo');
        const steps = document.querySelectorAll('.form-step-modern');
        const progressSteps = document.querySelectorAll('.progress-step-modern');
        const nextButtons = document.querySelectorAll('.btn-next');
        const backButtons = document.querySelectorAll('.btn-back');
        const submitBtn = document.getElementById('submitBtn');

        // Eventos de navegación
        nextButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const nextStep = parseInt(this.getAttribute('data-next'));
                if (validateCurrentStep()) {
                    showStep(nextStep);
                }
            });
        });

        backButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const prevStep = parseInt(this.getAttribute('data-back'));
                showStep(prevStep);
            });
        });

        // Mostrar/ocultar campo de marca personalizada
        document.getElementById('marca').addEventListener('change', function() {
            const otraMarca = document.getElementById('otra-marca');
            const marcaOtraInput = document.getElementById('marca_otra');

            if (this.value === 'Otra') {
                otraMarca.style.display = 'block';
                marcaOtraInput.required = true;
            } else {
                otraMarca.style.display = 'none';
                marcaOtraInput.required = false;
                marcaOtraInput.value = '';
            }
        });

        // Formateo automático de placa
        document.getElementById('placa').addEventListener('input', function() {
            let value = this.value.toUpperCase();
            // Remover caracteres no válidos
            value = value.replace(/[^A-Z0-9-]/g, '');
            this.value = value;
        });

        // Preview de foto
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('vehiclePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Preview de documentos
        ['archivo_ruat', 'archivo_soat', 'archivo_revision'].forEach(id => {
            document.getElementById(id).addEventListener('change', function(e) {
                const file = e.target.files[0];
                const nameSpan = document.getElementById(id + '_name');

                if (file) {
                    nameSpan.textContent = file.name;
                    nameSpan.style.color = 'var(--success-color)';
                } else {
                    nameSpan.textContent = '';
                }
            });
        });

        // Validación en tiempo real
        setupRealTimeValidation();

        // Submit del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                submitBtn.classList.add('loading');

                // Simular delay y enviar
                setTimeout(() => {
                    this.submit();
                }, 1000);
            }
        });

        console.log('Vehiculo crear form initialized');
    });

    function showStep(stepNumber) {
        // Ocultar todos los pasos
        document.querySelectorAll('.form-step-modern').forEach(step => {
            step.classList.remove('active');
        });

        // Mostrar paso actual
        document.querySelector(`.form-step-modern[data-step="${stepNumber}"]`).classList.add('active');

        // Actualizar indicador de progreso
        document.querySelectorAll('.progress-step-modern').forEach((step, index) => {
            step.classList.remove('active', 'completed');
            if (index + 1 === stepNumber) {
                step.classList.add('active');
            } else if (index + 1 < stepNumber) {
                step.classList.add('completed');
            }
        });

        // Scroll al inicio del formulario
        document.querySelector('.form-modern').scrollIntoView({
            behavior: 'smooth'
        });
    }

    function validateCurrentStep() {
        const activeStep = document.querySelector('.form-step-modern.active');
        const stepNumber = parseInt(activeStep.getAttribute('data-step'));

        let isValid = true;
        const requiredFields = activeStep.querySelectorAll('input[required], select[required]');

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showFieldError(field, 'Este campo es requerido');
                isValid = false;
            } else {
                clearFieldError(field);
            }
        });

        // Validaciones específicas por paso
        switch (stepNumber) {
            case 1:
                isValid = validateStep1() && isValid;
                break;
            case 2:
                isValid = validateStep2() && isValid;
                break;
            case 3:
                isValid = validateStep3() && isValid;
                break;
            case 4:
                isValid = validateStep4() && isValid;
                break;
        }

        return isValid;
    }

    function validateStep1() {
        let isValid = true;

        // Validar placa
        const placa = document.getElementById('placa');
        const placaRegex = /^[A-Z]{3}-[0-9]{4}$|^[0-9]{4}-[A-Z]{3}$/;

        if (!placaRegex.test(placa.value)) {
            showFieldError(placa, 'Formato de placa inválido (ABC-1234 o 1234-ABC)');
            isValid = false;
        }

        // Validar marca personalizada
        const marca = document.getElementById('marca');
        const marcaOtra = document.getElementById('marca_otra');

        if (marca.value === 'Otra' && !marcaOtra.value.trim()) {
            showFieldError(marcaOtra, 'Debe especificar la marca');
            isValid = false;
        }

        return isValid;
    }

    function validateStep2() {
        let isValid = true;

        // Validar kilometraje
        const kilometraje = document.getElementById('kilometraje');
        const km = parseInt(kilometraje.value);

        if (km < 0) {
            showFieldError(kilometraje, 'El kilometraje no puede ser negativo');
            isValid = false;
        }

        return isValid;
    }

    function validateStep3() {
        let isValid = true;

        // Validar fechas de vencimiento
        const fechaRuat = document.getElementById('fecha_vencimiento_ruat');
        const fechaSoat = document.getElementById('fecha_vencimiento_soat');
        const fechaRevision = document.getElementById('fecha_vencimiento_revision');

        const today = new Date().toISOString().split('T')[0];

        if (fechaRuat.value && fechaRuat.value < today) {
            showFieldError(fechaRuat, 'La fecha de vencimiento del RUAT no puede ser pasada');
            isValid = false;
        }

        if (fechaSoat.value && fechaSoat.value < today) {
            showFieldError(fechaSoat, 'La fecha de vencimiento del SOAT no puede ser pasada');
            isValid = false;
        }

        if (fechaRevision.value && fechaRevision.value < today) {
            showFieldError(fechaRevision, 'La fecha de vencimiento de la R.T. no puede ser pasada');
            isValid = false;
        }

        return isValid;
    }

    function validateStep4() {
        let isValid = true;

        // Validar fecha de próximo mantenimiento
        const proximoMantenimiento = document.getElementById('proximo_mantenimiento');
        const today = new Date().toISOString().split('T')[0];

        if (proximoMantenimiento.value && proximoMantenimiento.value < today) {
            showFieldError(proximoMantenimiento, 'La fecha de mantenimiento no puede ser pasada');
            isValid = false;
        }

        return isValid;
    }

    function validateForm() {
        let isValid = true;

        // Validar todos los pasos
        for (let i = 1; i <= 4; i++) {
            const step = document.querySelector(`.form-step-modern[data-step="${i}"]`);
            const requiredFields = step.querySelectorAll('input[required], select[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                }
            });
        }

        return isValid;
    }

    function showFieldError(field, message) {
        field.classList.add('error');
        const errorElement = document.getElementById(`error-${field.id}`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    function clearFieldError(field) {
        field.classList.remove('error');
        const errorElement = document.getElementById(`error-${field.id}`);
        if (errorElement) {
            errorElement.textContent = '';
            errorElement.style.display = 'none';
        }
    }

    function setupRealTimeValidation() {
        // Limpiar errores al escribir
        document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern').forEach(field => {
            field.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    clearFieldError(this);
                }
            });
        });
    }
</script>



<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>