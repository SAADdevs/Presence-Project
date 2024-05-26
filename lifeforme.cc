#include "Lifeform.h"
#include "shape.h"
#include "message.h"
#include "constantes.h"
#include <iostream>

// Constructeur sans argument de la classe Lifeform
Lifeform::Lifeform() : position(std::make_tuple(0, 0)), age(0) {}

// Constructeur avec initialisation de la classe Lifeform
Lifeform::Lifeform(std::tuple<int, int> pos, int a) : position(pos), age(a) {}

// Fonction pour tester l'âge de la classe Lifeform
void Lifeform::testAge() {
    if (age <= 0) {
        std::cout << message::lifeform_age(age);
        std::exit(EXIT_FAILURE);
    }
}

// Fonction pour tester la position de la classe Lifeform
void Lifeform::testPosition() {
    // Fonction pour tester la position de la classe Lifeform
    int x = std::get<0>(position);
    int y = std::get<1>(position);

    // Vérifier si la position est en dehors des limites [1, max-1]
    if (x <= 1 || y <= 1) {
        // Si la position est en dehors des limites, afficher un message d'erreur
        std::cout << message::lifeform_center_outside(x, y);
        std::exit(EXIT_FAILURE);
    }
}


// Constructeur sans argument
Alg::Alg() : Lifeform() {}

// Constructeur avec initialisation
Alg::Alg(std::tuple<int, int> pos, int a) : Lifeform(pos, a) {}
//**********************************************************************************************************

int Coral::indice = 0;
// Constructeur par défaut
Corail::Corail() : {}

// Constructeur avec argument
Corail::Corail(int x, int y, int age, int _id, Status_cor _status, Dir_rot_cor _direction, Status_dev _development,int _nbr_segment,  double* longueurs, double* angles)
    : Lifeform(std::make_tuple(x, y), age), id(_id), nbr_segment(_nbr_segment), status(_status), direction(_direction), development(_development) {
    P_S = new Segment[nbr_segment];
    double longueurs[nbr_segment];
    double angles[nbr_segment];
    // Initialiser le point de départ du premier segme
    // nt aux coordonnées x, y fournies
    double currentX = x;
    double currentY = y;

    for (int i = 0; i < nbr_segment; i++) {
        double endX = currentX + longueurs[i] * std::cos(angles[i]);
        double endY = currentY + longueurs[i] * std::sin(angles[i]);

        P_S[i].start = { currentX, currentY };
        P_S[i].end = { endX, endY };
        P_S[i].length = longueurs[i];
        P_S[i].angle = angles[i];

        // Mettre à jour la position actuelle pour correspondre à la fin du segment actuel
        currentX = endX;
        currentY = endY;
    }

    // Ajouter l'ID à la liste des IDs
    tab_id[indice] = id;
    // Incrémenter l'indice statique
    indice++;

    statut = (statut == 0) ? DEAD : ALIVE;
    direction = (direction == 0) ? TRIGO : INVTRIGO;
    development = (development == 0) ? EXTEND  : REPRO;
}
// Destructeur
Coral::~Coral() {
    delete[] P_S;
}

// Méthodes getters
Status_cor Coral::getStatus() const {
    return status;
}

Dir_rot_cor Coral::getDirection() const {
    return direction;
}

Status_dev Coral::getDevelopment() const {
    return development;
}

int Coral::getId() const {
    return id;
}

int Coral::getNbrSegment() const {
    return nbr_segment;
}

Segment Coral::getSegment(int index) const {
    if (index >= 0 && index < nbr_segment)
        return P_S[index];
    else
        throw std::out_of_range("Segment index out of bounds");
}

std::vector<int> Coral::getTabId() const {
    return tab_id;
}

int Corail::getIndice() {
    return indice;
}
// Fonction pour tester la longueur d'un segment
void Corail::testLength() const {
    for (int i = 0; i < nbr_segment; ++i) {
        double length = P_S[i].length;

        if (length < l_repro - l_seg_interne || length >= l_repro) {
            std::cout << message::segment_length_outside(id, length);
            std::exit(EXIT_FAILURE);
        }
    }
}

// Fonction pour tester les ID en double
void Corail::testDuplicatedId() const {
    std::vector<int> ids(tab_id, tab_id + indice);
    std::sort(ids.begin(), ids.end());

    // Check for duplicated IDs
    auto it = std::adjacent_find(ids.begin(), ids.end());
    if (it != ids.end()) {
        // Display error message using message::lifeform_duplicated_id function
        std::cout << message::lifeform_duplicated_id(*it);
        std::exit(EXIT_FAILURE);
    }
}

// Function to test the angle alpha of a segment
void Corail::testAlpha() const {
    for (int i = 0; i < nbr_segment; ++i) {
        double alpha = P_S[i].angle;

        if (alpha < -M_PI || alpha >= M_PI) {
            std::cout << message::segment_angle_outside(id, alpha);
            std::exit(EXIT_FAILURE);
        }
    }
}

// Function to test the position of the coral
void Corail::testPosition() const {
    // Check if the coral's position is within specific boundaries
    int x = std::get<0>(position);
    int y = std::get<1>(position);


    if (x <= 0 || x >= max_limit || y <= 0 || y >= max_limit) {
        std::cout << message::lifeform_computed_outside(id, x, y);
        std::exit(EXIT_FAILURE);
    }
}

Scavenger::Scavenger(int x, int y,int age, double _rayon, Status_sca _status, int _id_cor)
    : Lifeform(std::make_tuple(x, y), age), rayon(_rayon), id_cor(_id_cor), status(_status) {}

void Scavenger::testRayon() const {
    // Check if rayon is within a valid range
    if (rayon <= 0 || rayon > dmax) {
        // Display error message for radius outside allowed boundaries
        std::cout << message::scavenger_radius_outside(rayon);
        std::exit(EXIT_FAILURE);
    }
}

void Scavenger::testInvalidId()  {
    // Check if id_cor is a valid positive integer
    if (id_cor <= 0) {
        // Display error message for invalid ID
        std::cout << message::lifeform_invalid_id(id_cor);
        std::exit(EXIT_FAILURE);
    }
}






































