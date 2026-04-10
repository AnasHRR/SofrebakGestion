@extends('_layout')

@section('title', 'Ajouter un Client')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <!-- Breadcrumb equivalent or Back button -->
            <div class="mb-4 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Nouveau Client</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/clients"
                                    class="text-decoration-none text-muted">Clients</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Création</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('clients.index') }}"
                    class="btn btn-secondary btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i>
                    <span>Retour à la liste</span>
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark border-bottom py-3">
                    <h5 class="card-title mb-0 text-white">
                        <i class="bi bi-person-badge me-2"></i>Détails du Client
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="personne_contact" class="form-label fw-semibold">Nom du Contact <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-person text-white"></i></span>
                                        <input type="text" id="personne_contact" name="personne_contact"
                                            class="form-control border-start-0 shadow-none @error('personne_contact') is-invalid @enderror"
                                            placeholder="Nom Complet" required>
                                    </div>
                                    @error('personne_contact')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-telephone text-white"></i></span>
                                        <input type="text" id="telephone" name="telephone"
                                            class="form-control border-start-0 shadow-none @error('telephone') is-invalid @enderror"
                                            maxlength="14" placeholder="+212 6123456789 ">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="region_id" class="form-label fw-semibold">Région</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-geo-alt text-white"></i></span>
                                        <select name="region_id" id="region_id"
                                            class="form-select border-start-0 shadow-none">
                                            <option value="" selected disabled>Choisir une région...</option>
                                            @foreach ($region as $rg)
                                                <option value="{{ $rg->id }}">{{ $rg->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nom_entreprise" class="form-label fw-semibold">Entreprise</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-building text-white"></i></span>
                                        <input type="text" id="nom_entreprise" name="nom_entreprise"
                                            class="form-control border-start-0 shadow-none" placeholder="Raison Sociale">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-envelope text-white"></i></span>
                                        <input type="email" id="email" name="email"
                                            class="form-control border-start-0 shadow-none @error('email') is-invalid @enderror"
                                            placeholder="client@example.com">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="plafond_credit" class="form-label fw-semibold">Plafond de Crédit</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-end-0"><i
                                                class="bi bi-currency-dollar text-white"></i></span>
                                        <input type="number" step="0.01" id="plafond_credit" name="plafond_credit"
                                            class="form-control border-start-0 shadow-none" placeholder="0.00">
                                        <span class="input-group-text bg-primary text-white">DH</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Full Width Column -->
                            <div class="col-12 mt-2">
                                <div class="form-group mb-3">
                                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                                    <textarea id="adresse" name="adresse" class="form-control shadow-none" rows="3"
                                        placeholder="Ex: 134 lots bassma Massira Fès..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-4 mt-4">
                            <button type="reset" class="btn btn-light px-4 border text-muted">Réinitialiser</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm rounded-pill">
                                <i class="bi bi-check-circle me-1"></i> Créer le Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection