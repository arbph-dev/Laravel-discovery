@extends('layouts.app')

@section('title', 'À propos')

@section('content')
  <x-hero
    title="Nos engagements"
    subtitle="Un nouveau souffle pour une tradition responsable."
  />

  <div class="tabs">
    <div class="tab-buttons">
      <button class="tab-btn active" data-tab="durabilite">Durabilité</button>
      <button class="tab-btn" data-tab="transparence">Transparence</button>
      <button class="tab-btn" data-tab="innovation">Innovation</button>
    </div>

    <div class="tab-content active" id="durabilite">
      <h2>Durabilité</h2>
      <p>Production locale, agriculture régénérative, économie circulaire.</p>
    </div>
    <div class="tab-content" id="transparence">
      <h2>Transparence</h2>
      <p>Traçabilité complète, rapports publics, audits externes.</p>
    </div>
    <div class="tab-content" id="innovation">
      <h2>Innovation</h2>
      <p>Procédés sans conservateurs, emballages recyclables, et bientôt compostables.</p>
    </div>
  </div>
@endsection
