<div class="w-full h-96 rounded-lg shadow-lg" id="map"></div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('map', () => ({
            map: null,
            markers: [],
            init() {
                this.$nextTick(() => {
                    this.map = L.map('map').setView([51.505, -0.09], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(this.map);

                    // Add markers for goals
                    this.focusAreas.forEach(area => {
                        if (area.latitude && area.longitude) {
                            const marker = L.marker([area.latitude, area.longitude])
                                .addTo(this.map)
                                .bindPopup(`
                                    <h3 class="font-bold">${area.name}</h3>
                                    <p>${area.description || ''}</p>
                                    <div class="mt-2">
                                        <span class="text-sm">Progress: ${area.progress || 0}%</span>
                                    </div>
                                `);
                            this.markers.push(marker);
                        }
                    });
                });
            },
            addMarker(lat, lng, title, description) {
                const marker = L.marker([lat, lng])
                    .addTo(this.map)
                    .bindPopup(`
                        <h3 class="font-bold">${title}</h3>
                        <p>${description || ''}</p>
                    `);
                this.markers.push(marker);
                return marker;
            },
            removeMarker(marker) {
                this.map.removeLayer(marker);
                this.markers = this.markers.filter(m => m !== marker);
            }
        }));
    });
</script>
@endpush 