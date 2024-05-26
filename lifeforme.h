#ifndef LIFEFORM_H
#define LIFEFORM_H
#include "shape.h"
#include <tuple>
#include <string>
#include "message.h"
#include "constantes.h"

class Lifeform {
protected:
    std::tuple<int, int> position;
    int age;

public:
    // Constructeur sans argument
    Lifeform();

    // Constructeur avec initialisation
    Lifeform(std::tuple<int, int> pos, int a);

    // Fonction pour tester l'âge
    void testAge();

    // Fonction pour tester la position
    void testPosition();
};

class Alg : public Lifeform {
public:
    // Constructeur sans argument
    Alg();
    // Constructeur avec initialisation
    Alg(std::tuple<int, int> pos, int a);
};

class Corail : public Lifeform {
private:
    int id;
    Segment* P_S;
    int nbr_segment;
    static int tab_id[10];
    static int indice;
    Status_cor status;
    Dir_rot_cor direction;
    Status_dev development;
public:
    // Constructeur par défaut
    Corail();

    // Constructeur avec argument
    Corail(int x, int y, int age, int _id, int _nbr_segment, Status_cor _status, Dir_rot_cor _direction, Status_dev _development);

    // Destructeur
    ~Corail();

    // Méthodes getters
    Status_cor getStatus() const;
    Dir_rot_cor getDirection() const;
    Status_dev getDevelopment() const;
    int getId() const;
    int getNbrSegment() const;
    Segment getSegment(int index) const;
    static int getIndice();

    // Fonctions de test
    void testLength(int segment_index) const;
    void testAlpha(int segment_index) const;
    void testDuplicatedId() const;

    // Redéfinition de la fonction testPosition
    void testPosition() const override;
};


class Scavenger : public Lifeform {
private:
    double rayon;
    int id_cor;
    Status_sca status;

public:
    Scavenger(std::tuple<int, int> pos, int age, double _rayon, int _id_cor, Status_sca _status);

    void testRayon() const;
    void testInvalidId() const;

    // Add other member functions and getters/setters as needed
};





#endif // LIFEFORM_H
