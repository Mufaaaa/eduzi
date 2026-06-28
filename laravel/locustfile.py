from locust import HttpUser, task, between
from bs4 import BeautifulSoup

class LoginUser(HttpUser):
    wait_time = between(1, 2)

    @task
    def login(self):

        # Ambil halaman login untuk mendapatkan CSRF token
        response = self.client.get("/masuk")

        soup = BeautifulSoup(response.text, "html.parser")
        token = soup.find("input", {"name": "_token"})["value"]

        # Kirim request login
        with self.client.post(
            "/masuk",
            data={
                "_token": token,
                "email": "admin@gmail.com",
                "password": "password123"
            },
            catch_response=True
        ) as response:

            if response.status_code == 200 or response.status_code == 302:
                response.success()
            else:
                response.failure(f"Login gagal: {response.status_code}")