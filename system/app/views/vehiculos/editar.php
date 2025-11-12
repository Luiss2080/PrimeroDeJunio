<?php

/**
 * Vista Editar Vehículo - Sistema PRIMERO DE JUNIO
 */

$title = 'Editar Vehículo';
$current_page = 'vehiculos';

// Datos del vehículo
$vehiculo = $vehiculo ?? [];

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Editar Vehículo</span>
                        <span class="title-subtitle">Modificar información de <?= htmlspecialchars($vehiculo['placa'] ?? 'vehículo') ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-user"></i></span>
                        <span class="btn-text">Ver Perfil</span>
                    </a>
                    <a href="/admin/vehiculos" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
<?php if (isset($success_message)): ?>
    <div class="container-modern">
        <div class="alert-modern alert-success" data-aos="fade-up">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>¡Éxito!</strong>
                <span><?= htmlspecialchars($success_message) ?></span>
            </div>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
<?php endif; ?>

<!-- Tabs Container -->
<div class="container-modern">
    <div class="tabs-container-modern" data-aos="fade-up">
        <div class="tabs-header-modern">
            <button class="tab-button-modern active" data-tab="info-basica">
                <i class="fas fa-car"></i>
                Información Básica
            </button>
            <button class="tab-button-modern" data-tab="especificaciones">
                <i class="fas fa-cogs"></i>
                Especificaciones
            </button>
            <button class="tab-button-modern" data-tab="documentacion">
                <i class="fas fa-file-alt"></i>
                Documentación
            </button>
            <button class="tab-button-modern" data-tab="estado-config">
                <i class="fas fa-settings"></i>
                Estado y Config
            </button>
            <button class="tab-button-modern" data-tab="historial">
                <i class="fas fa-history"></i>
                Historial
            </button>
        </div>

        <div class="tabs-content-modern">
            <!-- Tab: Información Básica -->
            <div class="tab-content-modern active" data-tab="info-basica">
                <form class="form-modern" method="POST" action="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>/editar" enctype="multipart/form-data">
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
                                <!-- Photo Section -->
                                <div class="form-group-modern full-width">
                                    <div class="vehicle-edit-photo-modern">
                                        <div class="current-photo-modern">
                                            <img id="vehicleCurrentPhoto" src="<?= $vehiculo['foto'] ?? '/assets/images/default-vehicle.png' ?>" alt="Vehículo">
                                            <div class="photo-overlay-modern">
                                                <button type="button" class="btn-modern btn-sm btn-primary" onclick="document.getElementById('nueva_foto').click()">
                                                    <span class="btn-icon"><i class="fas fa-camera"></i></span>
                                                    <span class="btn-text">Cambiar Foto</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="photo-preview-modern" style="display: none;">
                                            <img id="vehicleNewPhoto" src="" alt="Nueva foto">
                                            <button type="button" class="btn-modern btn-sm btn-outline" onclick="cancelPhotoChange()">
                                                <span class="btn-icon"><i class="fas fa-times"></i></span>
                                                <span class="btn-text">Cancelar</span>
                                            </button>
                                        </div>
                                        <input type="file" id="nueva_foto" name="nueva_foto" accept="image/*" style="display: none;">
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
                                                value="<?= htmlspecialchars($vehiculo['placa'] ?? '') ?>"
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
                                                <?php
                                                $marcas = ['Toyota', 'Nissan', 'Hyundai', 'Chevrolet', 'Suzuki', 'Ford', 'Volkswagen', 'Kia', 'Mazda', 'Honda', 'Otra'];
                                                foreach ($marcas as $marca):
                                                ?>
                                                    <option value="<?= $marca ?>" <?= ($vehiculo['marca'] ?? '') === $marca ? 'selected' : '' ?>><?= $marca ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-error-modern" id="error-marca"></div>
                                    </div>

                                    <div class="form-group-modern" id="otra-marca" style="<?= ($vehiculo['marca'] ?? '') === 'Otra' ? 'display: block;' : 'display: none;' ?>">
                                        <label class="form-label-modern">Especificar Marca</label>
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            <input type="text"
                                                class="form-input-modern"
                                                name="marca_otra"
                                                id="marca_otra"
                                                value="<?= htmlspecialchars($vehiculo['marca_otra'] ?? '') ?>"
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
                                                value="<?= htmlspecialchars($vehiculo['modelo'] ?? '') ?>"
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
                                                    $selected = ($vehiculo['anio'] ?? '') == $year ? 'selected' : '';
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
                                                value="<?= htmlspecialchars($vehiculo['color'] ?? '') ?>"
                                                placeholder="Ej: Blanco, Azul, Rojo..."
                                                required>
                                        </div>
                                        <div class="form-error-modern" id="error-color"></div>
                                    </div>

                                    <div class="form-group-modern full-width">
                                        <label class="form-label-modern required">Tipo de Vehículo</label>
                                        <div class="radio-group-modern vehicle-types">
                                            <?php
                                            $tipos = [
                                                'sedan' => ['icon' => 'fas fa-car', 'label' => 'Sedán'],
                                                'suv' => ['icon' => 'fas fa-truck', 'label' => 'SUV'],
                                                'hatchback' => ['icon' => 'fas fa-car-side', 'label' => 'Hatchback'],
                                                'pickup' => ['icon' => 'fas fa-truck-pickup', 'label' => 'Pick-up'],
                                                'van' => ['icon' => 'fas fa-shuttle-van', 'label' => 'Van']
                                            ];
                                            foreach ($tipos as $value => $tipo):
                                            ?>
                                                <label class="radio-modern">
                                                    <input type="radio"
                                                        name="tipo"
                                                        value="<?= $value ?>"
                                                        <?= ($vehiculo['tipo'] ?? '') === $value ? 'checked' : '' ?>>
                                                    <span class="radio-check-modern"></span>
                                                    <div class="radio-content-modern">
                                                        <i class="<?= $tipo['icon'] ?>"></i>
                                                        <span><?= $tipo['label'] ?></span>
                                                    </div>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="form-error-modern" id="error-tipo"></div>
                                    </div>
                                </div>

                                <div class="form-actions-modern">
                                    <button type="submit" class="btn-modern btn-primary" name="seccion" value="info-basica">
                                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                                        <span class="btn-text">Guardar Información Básica</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </form>
            </div>

            <!-- Tab: Especificaciones -->
            <div class="tab-content-modern" data-tab="especificaciones">
                <form class="form-modern" method="POST" action="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>/editar">
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
                                                value="<?= htmlspecialchars($vehiculo['numero_motor'] ?? '') ?>"
                                                placeholder="Número del motor">
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['numero_chasis'] ?? '') ?>"
                                                placeholder="Número de chasis (VIN)">
                                        </div>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Capacidad de Pasajeros</label>
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <select class="form-select-modern" name="capacidad_pasajeros" id="capacidad_pasajeros">
                                                <option value="">Seleccionar capacidad</option>
                                                <option value="4" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '4' ? 'selected' : '' ?>>4 pasajeros</option>
                                                <option value="5" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '5' ? 'selected' : '' ?>>5 pasajeros</option>
                                                <option value="6" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '6' ? 'selected' : '' ?>>6 pasajeros</option>
                                                <option value="7" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '7' ? 'selected' : '' ?>>7 pasajeros</option>
                                                <option value="8" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '8' ? 'selected' : '' ?>>8 pasajeros</option>
                                                <option value="9" <?= ($vehiculo['capacidad_pasajeros'] ?? '') === '9' ? 'selected' : '' ?>>9+ pasajeros</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Tipo de Combustible</label>
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-gas-pump"></i>
                                            </div>
                                            <select class="form-select-modern" name="tipo_combustible" id="tipo_combustible">
                                                <option value="">Seleccionar combustible</option>
                                                <?php
                                                $combustibles = [
                                                    'gasolina' => 'Gasolina',
                                                    'diesel' => 'Diésel',
                                                    'gnv' => 'GNV (Gas Natural)',
                                                    'glp' => 'GLP (Gas Licuado)',
                                                    'hibrido' => 'Híbrido',
                                                    'electrico' => 'Eléctrico'
                                                ];
                                                foreach ($combustibles as $value => $label):
                                                ?>
                                                    <option value="<?= $value ?>" <?= ($vehiculo['tipo_combustible'] ?? '') === $value ? 'selected' : '' ?>><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Transmisión</label>
                                        <div class="radio-group-modern transmission-types">
                                            <label class="radio-modern">
                                                <input type="radio"
                                                    name="transmision"
                                                    value="manual"
                                                    <?= ($vehiculo['transmision'] ?? '') === 'manual' ? 'checked' : '' ?>>
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
                                                    <?= ($vehiculo['transmision'] ?? '') === 'automatica' ? 'checked' : '' ?>>
                                                <span class="radio-check-modern"></span>
                                                <div class="radio-content-modern">
                                                    <i class="fas fa-magic"></i>
                                                    <span>Automática</span>
                                                </div>
                                            </label>
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['kilometraje'] ?? '0') ?>"
                                                min="0"
                                                placeholder="0">
                                            <div class="input-suffix-modern">km</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Características -->
                                <div class="form-section-modern">
                                    <h3 class="section-title-modern">
                                        <i class="fas fa-plus-circle"></i>
                                        Características Adicionales
                                    </h3>

                                    <div class="checkbox-grid-modern">
                                        <?php
                                        $caracteristicas_opciones = [
                                            'aire_acondicionado' => ['icon' => 'fas fa-snowflake', 'label' => 'Aire Acondicionado'],
                                            'gps' => ['icon' => 'fas fa-map-marked-alt', 'label' => 'GPS'],
                                            'bluetooth' => ['icon' => 'fab fa-bluetooth', 'label' => 'Bluetooth'],
                                            'usb' => ['icon' => 'fab fa-usb', 'label' => 'Puerto USB'],
                                            'wifi' => ['icon' => 'fas fa-wifi', 'label' => 'WiFi'],
                                            'camara_retroceso' => ['icon' => 'fas fa-video', 'label' => 'Cámara de Retroceso']
                                        ];

                                        $caracteristicas_vehiculo = isset($vehiculo['caracteristicas']) ? json_decode($vehiculo['caracteristicas'], true) ?? [] : [];

                                        foreach ($caracteristicas_opciones as $value => $caracteristica):
                                        ?>
                                            <label class="checkbox-modern">
                                                <input type="checkbox"
                                                    name="caracteristicas[]"
                                                    value="<?= $value ?>"
                                                    <?= in_array($value, $caracteristicas_vehiculo) ? 'checked' : '' ?>>
                                                <span class="checkbox-check-modern">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <div class="checkbox-content-modern">
                                                    <i class="<?= $caracteristica['icon'] ?>"></i>
                                                    <span><?= $caracteristica['label'] ?></span>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="form-actions-modern">
                                    <button type="submit" class="btn-modern btn-primary" name="seccion" value="especificaciones">
                                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                                        <span class="btn-text">Guardar Especificaciones</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </form>
            </div>

            <!-- Tab: Documentación -->
            <div class="tab-content-modern" data-tab="documentacion">
                <form class="form-modern" method="POST" action="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>/editar" enctype="multipart/form-data">
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
                                                value="<?= htmlspecialchars($vehiculo['ruat'] ?? '') ?>"
                                                placeholder="Número RUAT">
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['fecha_vencimiento_ruat'] ?? '') ?>">
                                        </div>
                                        <?php if (!empty($vehiculo['fecha_vencimiento_ruat'])): ?>
                                            <div class="form-help-modern">
                                                <?php
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_ruat']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);

                                                if ($fecha < $hoy): ?>
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Vencido hace <?= $diff->days ?> días</span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="text-warning"><i class="fas fa-clock"></i> Vence en <?= $diff->days ?> días</span>
                                                <?php else: ?>
                                                    <span class="text-success"><i class="fas fa-check-circle"></i> Vigente por <?= $diff->days ?> días</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
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
                                                value="<?= htmlspecialchars($vehiculo['soat'] ?? '') ?>"
                                                placeholder="Número SOAT">
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['fecha_vencimiento_soat'] ?? '') ?>">
                                        </div>
                                        <?php if (!empty($vehiculo['fecha_vencimiento_soat'])): ?>
                                            <div class="form-help-modern">
                                                <?php
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_soat']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);

                                                if ($fecha < $hoy): ?>
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Vencido hace <?= $diff->days ?> días</span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="text-warning"><i class="fas fa-clock"></i> Vence en <?= $diff->days ?> días</span>
                                                <?php else: ?>
                                                    <span class="text-success"><i class="fas fa-check-circle"></i> Vigente por <?= $diff->days ?> días</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
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
                                                value="<?= htmlspecialchars($vehiculo['revision_tecnica'] ?? '') ?>"
                                                placeholder="Número de revisión técnica">
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['fecha_vencimiento_revision'] ?? '') ?>">
                                        </div>
                                        <?php if (!empty($vehiculo['fecha_vencimiento_revision'])): ?>
                                            <div class="form-help-modern">
                                                <?php
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_revision']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);

                                                if ($fecha < $hoy): ?>
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Vencido hace <?= $diff->days ?> días</span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="text-warning"><i class="fas fa-clock"></i> Vence en <?= $diff->days ?> días</span>
                                                <?php else: ?>
                                                    <span class="text-success"><i class="fas fa-check-circle"></i> Vigente por <?= $diff->days ?> días</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Documentos Digitales -->
                                <div class="form-section-modern">
                                    <h3 class="section-title-modern">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        Documentos Digitales
                                    </h3>

                                    <div class="documents-edit-modern">
                                        <!-- RUAT Digital -->
                                        <div class="document-edit-item-modern">
                                            <div class="document-header-modern">
                                                <h4>RUAT Digital</h4>
                                                <?php if (!empty($vehiculo['archivo_ruat'])): ?>
                                                    <a href="<?= $vehiculo['archivo_ruat'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                                        <span class="btn-text">Ver Actual</span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="file-upload-modern">
                                                <input type="file" id="nuevo_archivo_ruat" name="nuevo_archivo_ruat" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                                <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('nuevo_archivo_ruat').click()">
                                                    <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-text"><?= !empty($vehiculo['archivo_ruat']) ? 'Reemplazar RUAT' : 'Subir RUAT' ?></span>
                                                </button>
                                                <span class="file-name" id="nuevo_archivo_ruat_name"></span>
                                            </div>
                                        </div>

                                        <!-- SOAT Digital -->
                                        <div class="document-edit-item-modern">
                                            <div class="document-header-modern">
                                                <h4>SOAT Digital</h4>
                                                <?php if (!empty($vehiculo['archivo_soat'])): ?>
                                                    <a href="<?= $vehiculo['archivo_soat'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                                        <span class="btn-text">Ver Actual</span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="file-upload-modern">
                                                <input type="file" id="nuevo_archivo_soat" name="nuevo_archivo_soat" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                                <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('nuevo_archivo_soat').click()">
                                                    <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-text"><?= !empty($vehiculo['archivo_soat']) ? 'Reemplazar SOAT' : 'Subir SOAT' ?></span>
                                                </button>
                                                <span class="file-name" id="nuevo_archivo_soat_name"></span>
                                            </div>
                                        </div>

                                        <!-- Revisión Técnica Digital -->
                                        <div class="document-edit-item-modern">
                                            <div class="document-header-modern">
                                                <h4>Revisión Técnica Digital</h4>
                                                <?php if (!empty($vehiculo['archivo_revision'])): ?>
                                                    <a href="<?= $vehiculo['archivo_revision'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                                        <span class="btn-text">Ver Actual</span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="file-upload-modern">
                                                <input type="file" id="nuevo_archivo_revision" name="nuevo_archivo_revision" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                                <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('nuevo_archivo_revision').click()">
                                                    <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-text"><?= !empty($vehiculo['archivo_revision']) ? 'Reemplazar R.T.' : 'Subir R.T.' ?></span>
                                                </button>
                                                <span class="file-name" id="nuevo_archivo_revision_name"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions-modern">
                                    <button type="submit" class="btn-modern btn-primary" name="seccion" value="documentacion">
                                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                                        <span class="btn-text">Guardar Documentación</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </form>
            </div>

            <!-- Tab: Estado y Configuraciones -->
            <div class="tab-content-modern" data-tab="estado-config">
                <form class="form-modern" method="POST" action="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>/editar">
                    <div class="system-card-modern form-card">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-settings"></i>
                                    </div>
                                    <span>Estado y Configuraciones</span>
                                </div>
                            </div>

                            <div class="card-content-modern">
                                <div class="form-grid-modern">
                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Estado Actual</label>
                                        <select class="form-select-modern" name="estado" id="estado">
                                            <option value="disponible" <?= ($vehiculo['estado'] ?? '') === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                            <option value="ocupado" <?= ($vehiculo['estado'] ?? '') === 'ocupado' ? 'selected' : '' ?>>Ocupado</option>
                                            <option value="mantenimiento" <?= ($vehiculo['estado'] ?? '') === 'mantenimiento' ? 'selected' : '' ?>>En Mantenimiento</option>
                                            <option value="inactivo" <?= ($vehiculo['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Conductor Asignado</label>
                                        <select class="form-select-modern" name="conductor_id" id="conductor_id">
                                            <option value="">Sin asignar</option>
                                            <?php foreach ($conductores ?? [] as $conductor): ?>
                                                <option value="<?= $conductor['id'] ?>" <?= ($vehiculo['conductor_id'] ?? '') == $conductor['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?>
                                                    <?php if (!empty($conductor['licencia'])): ?>
                                                        (Licencia: <?= htmlspecialchars($conductor['licencia']) ?>)
                                                    <?php endif; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

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
                                                value="<?= htmlspecialchars($vehiculo['proximo_mantenimiento'] ?? '') ?>">
                                        </div>
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
                                                value="<?= htmlspecialchars($vehiculo['km_proximo_mantenimiento'] ?? '') ?>"
                                                placeholder="0">
                                            <div class="input-suffix-modern">km</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Observaciones -->
                                <div class="form-section-modern">
                                    <h3 class="section-title-modern">
                                        <i class="fas fa-comment-alt"></i>
                                        Observaciones
                                    </h3>

                                    <div class="form-group-modern full-width">
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-comment-dots"></i>
                                            </div>
                                            <textarea class="form-textarea-modern"
                                                name="observaciones"
                                                id="observaciones"
                                                rows="4"
                                                placeholder="Notas importantes sobre el vehículo, condiciones especiales, historial de reparaciones, etc."><?= htmlspecialchars($vehiculo['observaciones'] ?? '') ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions-modern">
                                    <button type="submit" class="btn-modern btn-primary" name="seccion" value="estado-config">
                                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                                        <span class="btn-text">Guardar Estado y Configuraciones</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </form>
            </div>

            <!-- Tab: Historial -->
            <div class="tab-content-modern" data-tab="historial">
                <div class="system-card-modern">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span>Historial del Vehículo</span>
                            </div>
                        </div>

                        <div class="card-content-modern">
                            <!-- Timeline del historial -->
                            <div class="timeline-modern">
                                <!-- Ejemplo de eventos del historial -->
                                <div class="timeline-item-modern">
                                    <div class="timeline-marker-modern success">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <div class="timeline-content-modern">
                                        <div class="timeline-header-modern">
                                            <h4>Vehículo Registrado</h4>
                                            <span class="timeline-date-modern"><?= date('d/m/Y H:i', strtotime($vehiculo['created_at'] ?? 'now')) ?></span>
                                        </div>
                                        <p>El vehículo fue registrado en el sistema por primera vez.</p>
                                    </div>
                                </div>

                                <!-- Aquí se mostrarían más eventos del historial desde la base de datos -->
                                <?php if (isset($historial_vehiculo) && !empty($historial_vehiculo)): ?>
                                    <?php foreach ($historial_vehiculo as $evento): ?>
                                        <div class="timeline-item-modern">
                                            <div class="timeline-marker-modern <?= $evento['tipo'] ?? 'info' ?>">
                                                <i class="<?= $evento['icono'] ?? 'fas fa-clock' ?>"></i>
                                            </div>
                                            <div class="timeline-content-modern">
                                                <div class="timeline-header-modern">
                                                    <h4><?= htmlspecialchars($evento['titulo']) ?></h4>
                                                    <span class="timeline-date-modern"><?= date('d/m/Y H:i', strtotime($evento['fecha'])) ?></span>
                                                </div>
                                                <p><?= htmlspecialchars($evento['descripcion']) ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="empty-state-modern">
                                        <div class="empty-icon-modern">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <h3>Sin historial adicional</h3>
                                        <p>No se han registrado eventos adicionales para este vehículo.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>
            </div>
        </div>
    </div>
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

        // Sistema de tabs
        initializeTabs();

        // Eventos específicos
        setupVehicleEditEvents();

        console.log('Vehiculo editar initialized');
    });

    function initializeTabs() {
        const tabButtons = document.querySelectorAll('.tab-button-modern');
        const tabContents = document.querySelectorAll('.tab-content-modern');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');

                // Remover clase active de todos los botones y contenidos
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activar botón y contenido correspondiente
                this.classList.add('active');
                document.querySelector(`[data-tab="${targetTab}"].tab-content-modern`).classList.add('active');
            });
        });
    }

    function setupVehicleEditEvents() {
        // Mostrar/ocultar campo de marca personalizada
        const marcaSelect = document.getElementById('marca');
        if (marcaSelect) {
            marcaSelect.addEventListener('change', function() {
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
        }

        // Preview de nueva foto
        const nuevaFoto = document.getElementById('nueva_foto');
        if (nuevaFoto) {
            nuevaFoto.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('vehicleNewPhoto').src = e.target.result;
                        document.querySelector('.current-photo-modern').style.display = 'none';
                        document.querySelector('.photo-preview-modern').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Formateo automático de placa
        const placaInput = document.getElementById('placa');
        if (placaInput) {
            placaInput.addEventListener('input', function() {
                let value = this.value.toUpperCase();
                value = value.replace(/[^A-Z0-9-]/g, '');
                this.value = value;
            });
        }

        // Preview de documentos
        ['nuevo_archivo_ruat', 'nuevo_archivo_soat', 'nuevo_archivo_revision'].forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const nameSpan = document.getElementById(id + '_name');

                    if (file) {
                        nameSpan.textContent = file.name;
                        nameSpan.style.color = 'var(--success-color)';
                    } else {
                        nameSpan.textContent = '';
                    }
                });
            }
        });
    }

    function cancelPhotoChange() {
        document.querySelector('.current-photo-modern').style.display = 'block';
        document.querySelector('.photo-preview-modern').style.display = 'none';
        document.getElementById('nueva_foto').value = '';
    }
</script>



<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>