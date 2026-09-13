from locust import HttpUser, task, between
from bs4 import BeautifulSoup

class KalkulatorUser(HttpUser):

    wait_time = between(1, 2)

    @task
    def predict(self):

        # Ambil halaman kalkulator (untuk CSRF)
        response = self.client.get("/kalkulator")

        soup = BeautifulSoup(response.text, "html.parser")
        token = soup.find("input", {"name": "_token"})["value"]

        with self.client.post(
            "/predict",
            data={
                "_token": token,
                "nama": "Budi",
                "jenis_kelamin": "Laki-laki",
                "umur_bulan": 24,
                "tinggi_badan": 82,
                "berat_badan": 11
            },
            catch_response=True
        ) as response:

            if response.status_code == 200:
                response.success()
            else:
                response.failure("Predict gagal")