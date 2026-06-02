#include <iomanip>
#include <iostream>
#include <vector>

void print_augmented_matrix(std::vector<std::vector<double>> &matrix) {
    for (int i = 0; i < matrix.size(); i++) {
        for (int j = 0; j < matrix.size() + 1; j++) {
            std::cout << std::setw(8)<< matrix[i][j] << " ";
        }
        std::cout << "\n";
    }
    std::cout << "\n";
}

void forward_elimination(std::vector<std::vector<double>> &matrix) {
    int height = matrix.size(); 
    int width = height + 1;
    for (int k = 0; k < height; k++) {
        for (int i = k + 1; i < height; i++) {
            for (int j = k + 1; j < width; j++) {
                matrix[i][j] = matrix[i][j] - (matrix[i][k] / matrix[k][k]) * matrix[k][j];
            }
            matrix[i][k] = 0;
        }
    }
}

std::vector<double> back_substitution(std::vector<std::vector<double>> &matrix) {
    int height = matrix.size();
    int width = height + 1;
    std::vector<double> result(height);
    for (int i = height - 1; i >= 0; i--) {
        double sum = 0;
        for (int j = i + 1; j < height; j++) {
            sum += matrix[i][j] * result[j];
        }
        result[i] = (matrix[i][width - 1] - sum) / matrix[i][i];
    }
    return result;
}

int main() {
    std::cout << "Gaussian Elimination\n";
    std::vector<std::vector<double>> matrix = {
        { 4, -2, 1, 12 },
        { -4, 6, 2, 10 },
        { 1, 3, -7, -1 }
    };

    for (int i = 0; i < matrix.size(); i++) {
        if (matrix[i].size() != matrix.size() + 1) {
            std::cout << "Invalid matrix dimensions! Expected n x (n+1) for augmented matrix"; 
            return 1;
        }
    }

    std::cout << "Initial matrix:\n";
    print_augmented_matrix(matrix);
    
    forward_elimination(matrix);
    
    std::cout << "Matrix after forbard elimination:\n";
    print_augmented_matrix(matrix);
    
    std::vector<double> result = back_substitution(matrix);
    
    std::cout << "Solution:\n";
    for (double x : result) {
        std::cout << x << " ";
    }

    return 0;
}
