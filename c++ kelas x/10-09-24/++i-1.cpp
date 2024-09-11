#include <iostream>

int main () {
    int i=10;
    std::cout << "menggunakan ++i" << std::endl;
    std::cout << "sebelum: " << i << std::endl;
    std::cout << "Nilai ++i: " << ++i <<  std::endl;
    std::cout << "setelah; " << i << std::endl;

    i = 10;

    std::cout << "menggunakan i++" << std::endl;
    std::cout << "sebelum: " << i << std::endl;
    std::cout << "Nilai i++: " << i++ <<  std::endl;
    std::cout << "setelah; " << i << std::endl;

    return 0;
}
