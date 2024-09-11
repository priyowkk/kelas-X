#include <iostream>

int main() {
    const int SIZE = 7;
    int num[SIZE] = {23,45,67, 23, 100, 45, 56};

    int total = 0;
    std::cout << "Menggunakan ++i untuk menghitung total dan rata-rata" << std::endl;
    for (int i = 0 ; i < SIZE ; ++i) {
        total += num[i];
        std::cout << "Menambahkan " << num[i] << ", total sementara : " << total<< std::endl;

    }
    double avg = static_cast<double>(total) / SIZE;
    std::cout << "Total (Pre-Increment) : " << total <<std::endl;
    std::cout << "Rata-rata (Pre-Increment) : " << avg << std::endl;

    return 0;
}
