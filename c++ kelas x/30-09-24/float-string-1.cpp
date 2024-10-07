#include <iostream>
#include <cmath>

using namespace std;

double a,b,c;
double ls {
    double s = (a + b + c) / 2;
    return sqrt(s * (s - a) * (s - b) * (s - c));
}

double hitungLuasPermukaanLimas(double a, double b, double c, double tLimas, double tSegitiga) {

    double luasAlas = hitungLuasSegitiga(a, b, c);


    double luasSisiTegak = 0.5 * a * tLimas + 0.5 * b * tLimas + 0.5 * c * tLimas;


    double luasTotal = luasAlas + luasSisiTegak;

    return luasTotal;
}

int main() {
    double a, b, c, tLimas, tSegitiga;


    cout << "Masukkan panjang sisi a: ";
    cin >> a;
    cout << "Masukkan panjang sisi b: ";
    cin >> b;
    cout << "Masukkan panjang sisi c: ";
    cin >> c;
    cout << "Masukkan tinggi limas: ";
    cin >> tLimas;


    double luasPermukaan = hitungLuasPermukaanLimas(a, b, c, tLimas, tSegitiga);


    cout << "Luas permukaan limas segi tiga adalah: " << luasPermukaan << endl;

    return 0;
}

